<?php

namespace App\Policies;

use App\Models\CourseRegistration;
use App\Models\User;

class CourseRegistrationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view registrations');
    }

    public function view(User $user, CourseRegistration $registration): bool
    {
        return $user->can('view registrations') || $this->owns($user, $registration);
    }

    public function create(User $user): bool
    {
        return $user->can('manage registrations') || $user->can('register courses');
    }

    /** Students may only drop their OWN registrations, and only before marks are entered. */
    public function delete(User $user, CourseRegistration $registration): bool
    {
        if ($user->can('manage registrations')) {
            return true;
        }

        return $user->can('register courses')
            && $this->owns($user, $registration)
            && $registration->grade === null;
    }

    private function owns(User $user, CourseRegistration $registration): bool
    {
        return $user->student !== null && $registration->student_id === $user->student->id;
    }
}
