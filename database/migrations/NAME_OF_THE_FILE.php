
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('nationality')->nullable();
            $table->string('district')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('entry_scheme')->nullable();
            $table->string('uace_index')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->string('guardian_phone')->nullable();
        });

        Schema::table('lecturers', function (Blueprint $table) {
            $table->string('specialisation')->nullable();
            $table->string('cv_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'nationality',
                'district',
                'photo_path',
                'entry_scheme',
                'uace_index',
                'guardian_name',
                'guardian_relationship',
                'guardian_phone',
            ]);
        });

        Schema::table('lecturers', function (Blueprint $table) {
            $table->dropColumn([
                'specialisation',
                'cv_path',
            ]);
        });
    }
};
