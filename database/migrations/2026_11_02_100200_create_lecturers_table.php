<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            // Every lecturer has exactly one login account.
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('staff_number')->nullable()->unique(); // given when approved
            $table->string('title')->nullable();                  // Dr. / Mr. / Ms. / Prof.
            $table->string('department')->nullable();
            $table->string('qualification')->nullable();          // PhD / Masters ...
            $table->string('employment_type')->default('Full-time');
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
