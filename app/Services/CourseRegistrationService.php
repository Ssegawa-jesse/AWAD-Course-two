<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

/**
 * All the business rules for registering a student on a course,
 * shared by the student portal and the admin screens.
 */
class CourseRegistrationService
{
    public const MAX_CREDIT_UNITS = 27;

    /**
     * @throws ValidationException when a rule is broken
     */
    public function register(Student $student, Course $course, string $field = 'course_id'): CourseRegistration
    {
        if (! $student->student_number) {
            $this->fail($field, 'This student has not been approved yet.');
        }

        if ($student->status !== 'Active') {
            $this->fail($field, "Only active students can register. This student is {$student->status}.");
        }

        // 1. Duplicate check (also enforced by the unique index in the database)
        if ($student->courses()->whereKey($course->id)->exists()) {
            $this->fail($field, "{$course->code} is already registered.");
        }

        // 2. Course capacity
        if ($course->registrations()->count() >= $course->capacity) {
            $this->fail($field, "{$course->code} is full ({$course->capacity} students).");
        }

        // 3. Credit-unit limit
        $load = $student->totalCreditUnits() + $course->credit_units;
        if ($load > self::MAX_CREDIT_UNITS) {
            $this->fail($field, "Registering {$course->code} would take the load to {$load} CU. The maximum is ".self::MAX_CREDIT_UNITS.' CU.');
        }

        try {
            return DB::transaction(fn () => CourseRegistration::create([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'academic_year' => '2026/2027',
                'semester' => $course->semester,
                'status' => 'Registered',
            ]));
        } catch (QueryException $e) {
            // Unique index (student_id, course_id) hit by a double click / race
            $this->fail($field, "{$course->code} is already registered.");
        }
    }

    private function fail(string $field, string $message): never
    {
        throw ValidationException::withMessages([$field => $message]);
    }
}
