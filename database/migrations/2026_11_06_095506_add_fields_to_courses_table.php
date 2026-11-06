
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('programme_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('lecturer_id')
                ->nullable()
                ->constrained('lecturers')
                ->nullOnDelete();

            $table->string('code')->unique();
            $table->string('title');
            $table->text('description')->nullable();

            $table->unsignedTinyInteger('credit_units');
            $table->unsignedTinyInteger('year_of_study');
            $table->unsignedTinyInteger('semester');

            $table->string('type');
            $table->unsignedSmallInteger('capacity')->default(60);

            $table->string('day')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('room')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['programme_id']);
            $table->dropForeign(['lecturer_id']);

            $table->dropUnique(['code']);

            $table->dropColumn([
                'programme_id',
                'lecturer_id',
                'code',
                'title',
                'description',
                'credit_units',
                'year_of_study',
                'semester',
                'type',
                'capacity',
                'day',
                'start_time',
                'end_time',
                'room',
            ]);
        });
    }
};

