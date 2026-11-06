
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->string('code')->unique();
            $table->string('name');
            $table->string('faculty');
            $table->string('level');
            $table->unsignedTinyInteger('duration_years');
        });
    }

    public function down(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->dropColumn([
                'code',
                'name',
                'faculty',
                'level',
                'duration_years'
            ]);
        });
    }
};

