<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * New accounts created through the register page start as "pending"
     * and can only sign in after the registrar approves them.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('approved')->after('password'); // pending | approved | rejected
            $table->string('account_type')->nullable()->after('status');      // student | lecturer | admin
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status', 'account_type']);
        });
    }
};
