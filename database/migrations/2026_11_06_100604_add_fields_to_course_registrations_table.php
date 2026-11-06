
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_registrations', function (Blueprint $table) {
            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('academic_year')->default('2026/2027');
            $table->unsignedTinyInteger('semester')->default(1);
            $table->string('status')->default('Registered');

            $table->decimal('coursework_mark', 5, 2)->nullable();
            $table->decimal('exam_mark', 5, 2)->nullable();

            $table->string('grade')->nullable();

            $table->unique(
                ['student_id', 'course_id'],
                'course_registrations_student_course_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('course_registrations', function (Blueprint $table) {
            $table->dropUnique(
                'course_registrations_student_course_unique'
            );

            $table->dropForeign(['student_id']);
            $table->dropForeign(['course_id']);

            $table->dropColumn([
                'student_id',
                'course_id',
                'academic_year',
                'semester',
                'status',
                'coursework_mark',
                'exam_mark',
                'grade',
            ]);
        });
    }
};

