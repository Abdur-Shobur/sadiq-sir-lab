<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            // Drop the existing role column if it exists
            $table->dropColumn('role');
        });
        
        Schema::table('teams', function (Blueprint $table) {
            // Add the role column as enum
            $table->enum('role', ['admin', 'team_member', 'advisor'])->default('team_member');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        
        Schema::table('teams', function (Blueprint $table) {
            $table->string('role')->default('team_member');
        });
    }
};
