<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programme_id')->nullable()->constrained()->nullOnDelete();
            // Lecturer assigned to teach the course (one lecturer has many courses).
            $table->foreignId('lecturer_id')->nullable()->constrained()->nullOnDelete();

            $table->string('code', 20)->unique();             // e.g. BBC2101
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('credit_units')->default(3);
            $table->unsignedTinyInteger('year_of_study')->default(1);
            $table->unsignedTinyInteger('semester')->default(1);
            $table->string('type')->default('Core');          // Core | Elective
            $table->unsignedSmallInteger('capacity')->default(100);

            // Timetable slot
            $table->string('day')->nullable();                // Monday ... Saturday
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('room')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
