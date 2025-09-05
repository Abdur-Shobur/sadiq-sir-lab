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
        Schema::table('events', function (Blueprint $table) {
            // Remove old fields
            $table->dropColumn(['subtitle', 'content', 'icon']);

            // Add new fields
            $table->text('description')->nullable()->after('title');
            $table->string('image')->nullable()->after('description');
            $table->date('event_date')->nullable()->after('image');
            $table->datetime('event_time')->nullable()->after('event_date');
            $table->string('time')->nullable()->after('event_time');
            $table->string('location')->nullable()->after('time');
            $table->integer('order')->default(0)->after('location');
            $table->enum('status', ['upcoming', 'ongoing', 'past'])->default('upcoming')->after('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Remove new fields
            $table->dropColumn(['description', 'image', 'event_date', 'event_time', 'time', 'location', 'order', 'status']);

            // Add back old fields
            $table->string('subtitle')->nullable()->after('title');
            $table->longText('content')->after('subtitle');
            $table->string('icon')->nullable()->after('content');
        });
    }
};
