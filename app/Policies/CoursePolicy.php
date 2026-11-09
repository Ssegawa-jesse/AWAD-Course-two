<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view courses') || $user->can('view available courses');
    }

    public function view(User $user, Course $course): bool
    {
        return $user->can('view courses') || $this->teaches($user, $course);
    }

    public function create(User $user): bool
    {
        return $user->can('create courses');
    }

    public function update(User $user, Course $course): bool
    {
        return $user->can('edit courses');
    }

    public function delete(User $user, Course $course): bool
    {
        return $user->can('delete courses');
    }

    /** A lecturer may only see the class list of a course assigned to them. */
    public function viewStudents(User $user, Course $course): bool
    {
        return $user->can('view registrations')
            || ($user->can('view course students') && $this->teaches($user, $course));
    }

    /** A lecturer may only enter marks for their own course. */
    public function enterMarks(User $user, Course $course): bool
    {
        return $user->can('enter marks') && $this->teaches($user, $course);
    }

    private function teaches(User $user, Course $course): bool
    {
        return $user->lecturer !== null && $course->lecturer_id === $user->lecturer->id;
    }
}
