<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['team_id', 'role_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_roles');
    }
};
