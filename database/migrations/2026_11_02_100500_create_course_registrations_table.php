<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pivot table between students and courses (many-to-many).
     * It also holds the marks the lecturer enters.
     */
    public function up(): void
    {
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('academic_year')->default('2026/2027');
            $table->unsignedTinyInteger('semester')->default(1);
            $table->string('status')->default('Registered');      // Registered | Completed

            $table->decimal('coursework_mark', 5, 2)->nullable(); // out of 30
            $table->decimal('exam_mark', 5, 2)->nullable();       // out of 70
            $table->string('grade', 3)->nullable();

            $table->timestamps();

            // A student can only register for the same course once.
            $table->unique(['student_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_registrations');
    }
};
