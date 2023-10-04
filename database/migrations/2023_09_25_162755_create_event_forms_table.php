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
        Schema::create('event_forms', function (Blueprint $table) {
            $table->id();
            // Define the foreign key relationship between EventForm and User models.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Automatically create two timestamp columns: created_at and updated_at
            $table->timestamps();
            
            // All required below for Google Calendar event create
            $table->text('event_title', 200);
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->text('description', 1000);
            $table->string('location', 200);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_forms');
    }
};
