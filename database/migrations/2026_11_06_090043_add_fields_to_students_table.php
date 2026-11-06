
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->unique()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('programme_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('student_number')->nullable()->unique();
            $table->string('registration_number')->nullable()->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->unsignedTinyInteger('year_of_study')->nullable();
            $table->string('study_mode')->nullable();
            $table->string('sponsorship')->nullable();
            $table->string('status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['programme_id']);

            $table->dropUnique(['user_id']);
            $table->dropUnique(['student_number']);
            $table->dropUnique(['registration_number']);
            $table->dropUnique(['email']);

            $table->dropColumn([
                'user_id',
                'programme_id',
                'student_number',
                'registration_number',
                'first_name',
                'last_name',
                'email',
                'phone',
                'gender',
                'date_of_birth',
                'year_of_study',
                'study_mode',
                'sponsorship',
                'status',
            ]);
        });
    }
};

