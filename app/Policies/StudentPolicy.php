<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;

/**
 * Who may see / change a student record.
 * Admins work with permissions; a student may only see their own record.
 */
class StudentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view students');
    }

    public function view(User $user, Student $student): bool
    {
        return $user->can('view students') || $student->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->can('create students');
    }

    public function update(User $user, Student $student): bool
    {
        return $user->can('edit students');
    }

    public function delete(User $user, Student $student): bool
    {
        return $user->can('delete students');
    }
}
