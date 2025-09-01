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
            $table->json('specialities')->nullable(); // JSON array for creatable fields
            $table->json('education')->nullable(); // JSON array for creatable fields
            $table->json('experience')->nullable(); // JSON array for creatable fields
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('website')->nullable();
            $table->json('social_media')->nullable(); // JSON array for creatable fields
            $table->string('password');
            $table->enum('role', ['admin', 'team'])->default('team');
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
