<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Programme;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StudentManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** Sign in as a user with a clean session (Jetstream checks the session belongs to that user). */
    private function as(User $user): static
    {
        $this->flushSession();

        return $this->actingAs($user);
    }

    private function admin(): User
    {
        return User::where('email', '2400725284@mubs.ac.ug')->first();
    }

    private function studentUser(string $email = 'sarah.nakato@students.mubs.ac.ug'): User
    {
        return User::where('email', $email)->first();
    }

    /* ---------- Q1: relationships ---------- */

    public function test_eloquent_relationships_work(): void
    {
        $sarah = Student::where('email', 'sarah.nakato@students.mubs.ac.ug')->first();
        $course = Course::where('code', 'BBC3101')->first();

        $this->assertInstanceOf(Programme::class, $sarah->programme);                // belongsTo
        $this->assertTrue($sarah->programme->students->contains($sarah));            // hasMany
        $this->assertTrue($sarah->courses->contains($course));                       // belongsToMany
        $this->assertTrue($course->students->contains($sarah));                      // belongsToMany (inverse)
        $this->assertSame($course->lecturer->user->name, 'Dr. Moses Kato');          // belongsTo → belongsTo
        $this->assertTrue($course->lecturer->courses->contains($course));            // hasMany
    }

    public function test_database_blocks_duplicate_registrations(): void
    {
        $this->expectException(QueryException::class);

        $existing = CourseRegistration::first();
        CourseRegistration::create(['student_id' => $existing->student_id, 'course_id' => $existing->course_id]);
    }

    /* ---------- Q2: seeders ---------- */

    public function test_seeders_create_sample_data_and_do_not_duplicate(): void
    {
        $counts = fn () => [User::count(), Student::count(), Course::count(), CourseRegistration::count(), Role::count(), Permission::count()];
        $before = $counts();

        $this->assertGreaterThanOrEqual(5, Student::enrolled()->count());
        $this->assertGreaterThanOrEqual(4, Course::count());

        $this->seed(); // run again

        $this->assertSame($before, $counts());
    }

    /* ---------- Q3: roles, permissions & access ---------- */

    public function test_roles_have_the_right_permissions(): void
    {
        $this->assertTrue($this->admin()->hasRole('admin'));
        $this->assertTrue($this->admin()->can('manage users'));
        $this->assertTrue(User::where('email', 'moses.kato@mubs.ac.ug')->first()->can('enter marks'));
        $this->assertFalse($this->studentUser()->can('view students'));
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/admin/students')->assertRedirect('/login');
        $this->get('/student/courses')->assertRedirect('/login');
    }

    public function test_each_role_only_reaches_its_own_area(): void
    {
        $this->as($this->studentUser())->get('/admin/students')->assertForbidden();
        $this->as($this->studentUser())->get('/lecturer/courses')->assertForbidden();
        $this->as(User::where('email', 'moses.kato@mubs.ac.ug')->first())->get('/admin/courses')->assertForbidden();
        $this->as($this->admin())->get('/admin/students')->assertOk();
    }

    public function test_lecturer_cannot_open_another_lecturers_course(): void
    {
        $moses = User::where('email', 'moses.kato@mubs.ac.ug')->first();
        $ruthsCourse = Course::where('code', 'BBC3102')->first();
        $ownCourse = Course::where('code', 'BBC3101')->first();

        $this->as($moses)->get(route('lecturer.courses.show', $ownCourse))->assertOk()->assertSee('Sarah Nakato');
        $this->as($moses)->get(route('lecturer.courses.show', $ruthsCourse))->assertForbidden();
    }

    public function test_student_cannot_drop_another_students_registration(): void
    {
        $john = $this->studentUser('john.okello@students.mubs.ac.ug');
        $sarahsRegistration = Student::where('email', 'sarah.nakato@students.mubs.ac.ug')->first()->registrations()->first();

        $this->as($john)->delete(route('student.registrations.destroy', $sarahsRegistration))->assertForbidden();
        $this->assertModelExists($sarahsRegistration);
    }

    /* ---------- Q4: CRUD + registration ---------- */

    public function test_admin_can_create_update_and_delete_a_student(): void
    {
        $this->as($this->admin())->post(route('admin.students.store'), [
            'first_name' => 'Brian', 'last_name' => 'Okot', 'email' => 'brian@example.com', 'gender' => 'Male',
            'programme_id' => Programme::first()->id, 'year_of_study' => 2, 'study_mode' => 'Day',
            'sponsorship' => 'Private', 'status' => 'Active',
        ])->assertRedirect()->assertSessionHas('success');

        $brian = Student::where('email', 'brian@example.com')->firstOrFail();
        $this->assertNotNull($brian->student_number);
        $this->assertTrue($brian->user->hasRole('student'));

        $this->as($this->admin())->put(route('admin.students.update', $brian), [
            ...$brian->only(['first_name', 'email', 'gender', 'programme_id', 'year_of_study', 'study_mode', 'sponsorship', 'status']),
            'last_name' => 'Okot-Otim',
        ])->assertSessionHas('success');
        $this->assertSame('Okot-Otim', $brian->fresh()->last_name);

        $this->as($this->admin())->delete(route('admin.students.destroy', $brian))->assertSessionHas('success');
        $this->assertModelMissing($brian);
    }

    public function test_student_validation_errors(): void
    {
        $this->as($this->admin())->post(route('admin.students.store'), ['email' => 'not-an-email'])
            ->assertSessionHasErrors(['first_name', 'last_name', 'email', 'gender', 'programme_id', 'study_mode', 'status']);
    }

    public function test_admin_can_create_update_and_delete_a_course(): void
    {
        $data = ['code' => 'BBC3199', 'title' => 'Cloud Computing', 'programme_id' => Programme::first()->id,
            'credit_units' => 3, 'year_of_study' => 3, 'semester' => 1, 'type' => 'Elective', 'capacity' => 30];

        $this->as($this->admin())->post(route('admin.courses.store'), $data)->assertSessionHas('success');
        $course = Course::where('code', 'BBC3199')->firstOrFail();

        $this->as($this->admin())->put(route('admin.courses.update', $course), [...$data, 'capacity' => 45])->assertSessionHas('success');
        $this->assertSame(45, $course->fresh()->capacity);

        $this->as($this->admin())->post(route('admin.courses.store'), $data)->assertSessionHasErrors('code');

        $this->as($this->admin())->delete(route('admin.courses.destroy', $course))->assertSessionHas('success');
        $this->assertModelMissing($course);
    }

    public function test_student_registers_for_a_course_once_only(): void
    {
        $daniel = $this->studentUser('daniel.ssempijja@students.mubs.ac.ug');
        $course = Course::where('code', 'BBC3102')->first();

        $this->as($daniel)->post(route('student.courses.store'), ['course_ids' => [$course->id]])
            ->assertSessionHas('success');
        $this->assertTrue($daniel->student->courses()->whereKey($course->id)->exists());

        $this->as($daniel)->post(route('student.courses.store'), ['course_ids' => [$course->id]])
            ->assertSessionHas('error');
        $this->assertSame(1, CourseRegistration::where(['student_id' => $daniel->student->id, 'course_id' => $course->id])->count());
    }

    public function test_admin_duplicate_registration_is_rejected(): void
    {
        $existing = CourseRegistration::first();

        $this->as($this->admin())->post(route('admin.registrations.store'), [
            'student_id' => $existing->student_id, 'course_id' => $existing->course_id,
        ])->assertSessionHasErrors('course_id');
    }

    public function test_suspended_student_cannot_register(): void
    {
        $kevin = $this->studentUser('kevin.mugabi@students.mubs.ac.ug');

        $this->as($kevin)->post(route('student.courses.store'), ['course_ids' => [Course::first()->id]])
            ->assertSessionHas('error');
        $this->assertSame(0, $kevin->student->registrations()->count());
    }

    public function test_admin_approves_a_pending_registration(): void
    {
        $hassan = User::where('email', 'hassan.kato@gmail.com')->first();

        $this->as($this->admin())->post(route('admin.approvals.approve', $hassan))->assertSessionHas('success');

        $this->assertTrue($hassan->fresh()->isApproved());
        $this->assertNotNull($hassan->student->fresh()->student_number);
    }

    public function test_lecturer_enters_marks_and_grade_is_calculated(): void
    {
        $moses = User::where('email', 'moses.kato@mubs.ac.ug')->first();
        $course = Course::where('code', 'BBC3101')->first();
        $registration = $course->registrations()->first();

        $this->as($moses)->put(route('lecturer.courses.marks.update', $course), [
            'marks' => [$registration->id => ['coursework' => 25, 'exam' => 60]],
        ])->assertSessionHas('success');

        $this->assertSame('A', $registration->fresh()->grade);

        $this->as($moses)->put(route('lecturer.courses.marks.update', $course), [
            'marks' => [$registration->id => ['coursework' => 50, 'exam' => 90]],
        ])->assertSessionHasErrors();
    }

    /* ---------- Q4d / Q5d: role-based display ---------- */

    public function test_navigation_matches_permissions(): void
    {
        $this->as($this->admin())->get('/admin/dashboard')->assertSee('Users &amp; roles', false)->assertSee('Approvals');
        $this->as($this->studentUser())->get('/student/dashboard')->assertSee('Course registration')->assertDontSee('Users &amp; roles', false);
    }
}
