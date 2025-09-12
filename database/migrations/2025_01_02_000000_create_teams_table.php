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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('designation');
            $table->json('specialities')->nullable();
            $table->json('education')->nullable();
            $table->json('experience')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->json('social_media')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'team_member', 'advisor'])->default('team_member'); // Updated roles
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
