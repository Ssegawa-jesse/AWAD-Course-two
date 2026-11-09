<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Programme;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $programmes = Programme::pluck('id', 'code');
        $lecturers = Lecturer::with('user')->get()->keyBy(fn ($l) => $l->user->email);

        $courses = [
            // code, title, CU, year, type, programme, lecturer email, day, start, end, room
            ['BBC3101', 'Advanced Web Application Development', 4, 3, 'Core', 'BBC', 'moses.kato@mubs.ac.ug', 'Monday', '08:00', '11:00', 'Lab 3'],
            ['BBC3102', 'Mobile Applications Development', 4, 3, 'Core', 'BBC', 'ruth.atim@mubs.ac.ug', 'Tuesday', '11:00', '14:00', 'Lab 1'],
            ['BBC3103', 'Information Security & Auditing', 3, 3, 'Core', 'BBC', 'paul.wasswa@mubs.ac.ug', 'Wednesday', '08:00', '10:00', 'Room 4B'],
            ['BBC3104', 'Accounting Information Systems', 3, 3, 'Core', 'BBC', 'esther.namubiru@mubs.ac.ug', 'Thursday', '14:00', '16:00', 'Room 2A'],
            ['BBC3105', 'IT Project Development', 4, 3, 'Core', 'BBC', 'ivan.mugisha@mubs.ac.ug', 'Friday', '08:00', '11:00', 'Lab 2'],
            ['BBC3111', 'Data Science with Python', 3, 3, 'Elective', 'BBC', 'moses.kato@mubs.ac.ug', 'Friday', '14:00', '16:00', 'Lab 3'],
            ['BIT1101', 'Introduction to Programming', 4, 1, 'Core', 'BIT', 'ruth.atim@mubs.ac.ug', 'Monday', '14:00', '17:00', 'Lab 1'],
            ['BIT1102', 'Computer Networks Fundamentals', 3, 1, 'Core', 'BIT', 'paul.wasswa@mubs.ac.ug', 'Thursday', '08:00', '10:00', 'Room 1C'],
        ];

        foreach ($courses as [$code, $title, $cu, $year, $type, $prog, $lecturer, $day, $start, $end, $room]) {
            Course::updateOrCreate(['code' => $code], [
                'title' => $title,
                'credit_units' => $cu,
                'year_of_study' => $year,
                'semester' => 1,
                'type' => $type,
                'capacity' => 60,
                'programme_id' => $programmes[$prog] ?? null,
                'lecturer_id' => $lecturers[$lecturer]->id ?? null,
                'day' => $day,
                'start_time' => $start,
                'end_time' => $end,
                'room' => $room,
                'description' => "$title for $prog Year $year students.",
            ]);
        }
    }
}
