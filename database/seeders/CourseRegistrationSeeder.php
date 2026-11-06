<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Database\Seeder;

class CourseRegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $course = fn (string $code) => Course::where('code', $code)->value('id');

        $plan = [
            // student email => [course code => [coursework /30, exam /70] or null for no marks yet]
            'sarah.nakato@students.mubs.ac.ug' => ['BBC3101' => [26, 58], 'BBC3102' => [24, 50], 'BBC3103' => [22, 47], 'BBC3105' => null, 'BBC3111' => null],
            'john.okello@students.mubs.ac.ug' => ['BBC3101' => [20, 45], 'BBC3102' => [18, 40], 'BBC3104' => [25, 52]],
            'daniel.ssempijja@students.mubs.ac.ug' => ['BBC3101' => [28, 60], 'BBC3103' => null, 'BBC3104' => null],
            'aisha.namuli@students.mubs.ac.ug' => ['BIT1101' => [27, 55], 'BIT1102' => null],
            'patience.achan@students.mubs.ac.ug' => ['BBC3104' => null],
        ];

        foreach ($plan as $email => $courses) {
            $student = Student::where('email', $email)->first();
            if (! $student) {
                continue;
            }

            foreach ($courses as $code => $marks) {
                $courseId = $course($code);
                if (! $courseId) {
                    continue;
                }

                $data = ['academic_year' => '2026/2027', 'semester' => 1, 'status' => 'Registered'];

                if ($marks) {
                    [$cw, $exam] = $marks;
                    $data += [
                        'coursework_mark' => $cw,
                        'exam_mark' => $exam,
                        'grade' => CourseRegistration::gradeFor($cw + $exam),
                    ];
                }

                // Unique (student_id, course_id) → re-running never duplicates
                CourseRegistration::updateOrCreate(
                    ['student_id' => $student->id, 'course_id' => $courseId],
                    $data
                );
            }
        }
    }
}
