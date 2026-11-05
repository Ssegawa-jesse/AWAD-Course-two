<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Every permission in the system, grouped by role.
     * firstOrCreate + syncPermissions means running the seeder again
     * never creates duplicates.
     */
    public const PERMISSIONS = [
        // Administrator (Registrar)
        'view students', 'create students', 'edit students', 'delete students',
        'view courses', 'create courses', 'edit courses', 'delete courses',
        'manage programmes', 'manage lecturers',
        'view registrations', 'manage registrations',
        'approve registrations', 'manage users', 'view reports',

        // Lecturer
        'view assigned courses', 'view course students', 'enter marks',

        // Student
        'view available courses', 'register courses', 'view own registrations', 'view own results',
    ];

    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (self::PERMISSIONS as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'view students', 'create students', 'edit students', 'delete students',
            'view courses', 'create courses', 'edit courses', 'delete courses',
            'manage programmes', 'manage lecturers',
            'view registrations', 'manage registrations',
            'approve registrations', 'manage users', 'view reports',
        ]);

        $lecturer = Role::firstOrCreate(['name' => 'lecturer', 'guard_name' => 'web']);
        $lecturer->syncPermissions([
            'view assigned courses', 'view course students', 'enter marks',
        ]);

        $student = Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']);
        $student->syncPermissions([
            'view available courses', 'register courses', 'view own registrations', 'view own results',
        ]);
    }
}
