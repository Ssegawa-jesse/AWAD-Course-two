<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // Login account of the student (one-to-one).
            $table->foreignId('user_id')->nullable()->unique()->constrained()->cascadeOnDelete();
            // Programme the student is enrolled on (one programme has many students).
            $table->foreignId('programme_id')->nullable()->constrained()->nullOnDelete();

            $table->string('student_number')->nullable()->unique(); // given when approved
            $table->string('registration_number')->nullable()->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->unsignedTinyInteger('year_of_study')->default(1);
            $table->string('study_mode')->default('Day');         // Day | Evening | Weekend
            $table->string('sponsorship')->default('Private');    // Private | Government | Scholarship
            $table->string('status')->default('Active');          // Active | Suspended | Inactive | Graduated
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
