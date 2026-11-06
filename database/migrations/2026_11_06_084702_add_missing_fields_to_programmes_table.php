
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->string('faculty')->nullable();
            $table->string('level')->nullable();
            $table->unsignedTinyInteger('duration_years')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->dropColumn([
                'faculty',
                'level',
                'duration_years'
            ]);
        });
    }
};

