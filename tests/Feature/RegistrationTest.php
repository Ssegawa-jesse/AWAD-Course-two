<?php

namespace Tests\Feature;

use App\Models\Programme;
use App\Models\User;
use Database\Seeders\ProgrammeSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([RolesAndPermissionsSeeder::class, ProgrammeSeeder::class]);
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $this->get('/register')->assertOk()->assertSee('Create your account');
    }

    public function test_new_students_register_as_pending_and_cannot_sign_in(): void
    {
        $response = $this->post('/register', [
            'account_type' => 'student',
            'first_name' => 'Grace',
            'last_name' => 'Akello',
            'email' => 'grace@example.com',
            'programme_id' => Programme::first()->id,
            'study_mode' => 'Day',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('registration.success'));
        $this->assertGuest();

        $user = User::where('email', 'grace@example.com')->first();
        $this->assertSame(User::STATUS_PENDING, $user->status);
        $this->assertTrue($user->hasRole('student'));
        $this->assertNotNull($user->student);
        $this->assertNull($user->student->student_number);

        $this->post('/login', ['email' => 'grace@example.com', 'password' => 'password'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_registration_is_validated(): void
    {
        $this->post('/register', ['account_type' => 'student'])
            ->assertSessionHasErrors(['first_name', 'last_name', 'email', 'password', 'programme_id', 'study_mode']);
    }
}
