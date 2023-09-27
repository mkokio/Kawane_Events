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
            $table->timestamps();
            // all required below
            // Title
            $table->text('event_title', 200);
            // Start date
            $table->date('start_date');
            // Start time
            $table->time('start_time');
            // End date
            $table->date('end_date');
            // End Time
            $table->time('end_time');
            // Event Description
            $table->text('description', 1000);
            // Address/Location
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
