<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();          // e.g. BBC
            $table->string('name');                        // Bachelor of Business Computing
            $table->string('faculty')->nullable();
            $table->string('level')->default('Bachelor');  // Bachelor | Diploma | Certificate
            $table->unsignedTinyInteger('duration_years')->default(3);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
