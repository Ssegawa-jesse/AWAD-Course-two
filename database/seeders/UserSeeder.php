<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use App\Models\Programme;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /** Password for every sample account. */
    public const PASSWORD = '12345678';

    public function run(): void
    {
        /* ---------- Administrator (Registrar) ---------- */
        $admin = $this->user('Academic Registrar', '2400725284@mubs.ac.ug', 'admin');
        $admin->syncRoles(['admin']);

        /* ---------- Lecturers ---------- */
        $lecturers = [
            ['Dr. Moses Kato', 'moses.kato@mubs.ac.ug', 'Dr.', 'Computing & Informatics', 'PhD', 'STF-2026-0001'],
            ['Ms. Ruth Atim', 'ruth.atim@mubs.ac.ug', 'Ms.', 'Computing & Informatics', 'Masters', 'STF-2026-0002'],
            ['Mr. Paul Wasswa', 'paul.wasswa@mubs.ac.ug', 'Mr.', 'Information Systems', 'Masters', 'STF-2026-0003'],
            ['Dr. Esther Namubiru', 'esther.namubiru@mubs.ac.ug', 'Dr.', 'Accounting', 'PhD', 'STF-2026-0004'],
            ['Mr. Ivan Mugisha', 'ivan.mugisha@mubs.ac.ug', 'Mr.', 'Computing & Informatics', 'Masters', 'STF-2026-0005'],
        ];

        foreach ($lecturers as [$name, $email, $title, $department, $qualification, $staffNo]) {
            $user = $this->user($name, $email, 'lecturer');
            $user->syncRoles(['lecturer']);

            Lecturer::updateOrCreate(['user_id' => $user->id], [
                'staff_number' => $staffNo,
                'title' => $title,
                'department' => $department,
                'qualification' => $qualification,
                'employment_type' => 'Full-time',
                'phone' => '+256 700 000 '.substr($staffNo, -3),
            ]);
        }

        /* ---------- Students ---------- */
        $programmes = Programme::pluck('id', 'code');

        $students = [
            // first, last, email, programme, year, mode, status, student no, gender
            ['Sarah', 'Nakato', 'sarah.nakato@students.mubs.ac.ug', 'BBC', 3, 'Evening', 'Active', '2400714521', 'Female'],
            ['John', 'Okello', 'john.okello@students.mubs.ac.ug', 'BBC', 3, 'Day', 'Active', '2400711873', 'Male'],
            ['Aisha', 'Namuli', 'aisha.namuli@students.mubs.ac.ug', 'BIT', 1, 'Day', 'Active', '2400716204', 'Female'],
            ['Kevin', 'Mugabi', 'kevin.mugabi@students.mubs.ac.ug', 'BCOM', 3, 'Evening', 'Suspended', '2300709945', 'Male'],
            ['Patience', 'Achan', 'patience.achan@students.mubs.ac.ug', 'BPLM', 1, 'Weekend', 'Active', '2400718830', 'Female'],
            ['Daniel', 'Ssempijja', 'daniel.ssempijja@students.mubs.ac.ug', 'BBC', 3, 'Day', 'Active', '2300702317', 'Male'],
            ['Mercy', 'Atuhaire', 'mercy.atuhaire@students.mubs.ac.ug', 'BHRM', 3, 'Evening', 'Graduated', '2200698124', 'Female'],
            ['Ibrahim', 'Lubega', 'ibrahim.lubega@students.mubs.ac.ug', 'DCS', 1, 'Day', 'Inactive', '2400719402', 'Male'],
        ];

        foreach ($students as $i => [$first, $last, $email, $prog, $year, $mode, $status, $number, $gender]) {
            $user = $this->user("$first $last", $email, 'student');
            $user->syncRoles(['student']);

            Student::updateOrCreate(['email' => $email], [
                'user_id' => $user->id,
                'programme_id' => $programmes[$prog] ?? null,
                'student_number' => $number,
                'registration_number' => sprintf('%s/U/%05d/%s', substr($number, 0, 2), 4000 + $i, strtoupper(substr($mode, 0, 3))),
                'first_name' => $first,
                'last_name' => $last,
                'phone' => '+256 77'.$i.' 123 45'.$i,
                'gender' => $gender,
                'date_of_birth' => now()->subYears(20 + ($i % 4))->subDays($i * 17)->toDateString(),
                'year_of_study' => $year,
                'study_mode' => $mode,
                'sponsorship' => $i % 3 === 0 ? 'Government' : 'Private',
                'status' => $status,
            ]);
        }

        /* ---------- Pending online registrations (for the Approvals page) ---------- */
        $pendingStudents = [
            ['Hassan', 'Kato', 'hassan.kato@gmail.com', 'BBC'],
            ['Doreen', 'Nantongo', 'doreen.nantongo@gmail.com', 'BIT'],
        ];

        foreach ($pendingStudents as [$first, $last, $email, $prog]) {
            $user = $this->user("$first $last", $email, 'student', User::STATUS_PENDING);
            $user->syncRoles(['student']);

            Student::updateOrCreate(['email' => $email], [
                'user_id' => $user->id,
                'programme_id' => $programmes[$prog] ?? null,
                'first_name' => $first,
                'last_name' => $last,
                'year_of_study' => 1,
                'study_mode' => 'Day',
                'status' => 'Active',
            ]);
        }

        $pendingLecturer = $this->user('Dr. Florence Nabukenya', 'florence.nabukenya@gmail.com', 'lecturer', User::STATUS_PENDING);
        $pendingLecturer->syncRoles(['lecturer']);
        Lecturer::updateOrCreate(['user_id' => $pendingLecturer->id], [
            'title' => 'Dr.', 'department' => 'Information Technology', 'qualification' => 'PhD',
        ]);
    }

    /** Create the user once; later runs only update it (no duplicates). */
    private function user(string $name, string $email, string $type, string $status = User::STATUS_APPROVED): User
    {
        return User::updateOrCreate(['email' => $email], [
            'name' => $name,
            'password' => self::PASSWORD,   // hashed by the 'hashed' cast
            'status' => $status,
            'account_type' => $type,
        ]);
    }
}
