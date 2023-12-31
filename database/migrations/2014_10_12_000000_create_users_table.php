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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // Additional info (all optional)
            $table->string('business_name', 100)->nullable();
            $table->string('public_name', 70)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('contact_email', 50)->nullable();
            $table->string('instagram', 50)->nullable();
            $table->string('twitter', 50)->nullable();
            $table->string('homepage', 100)->nullable();
            // event color choice (dropdown list)
            $table->enum('colors', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'])->default('1');
            //1 Lavender
            //2 Sage
            //3 Grape
            //4 Flamingo
            //5 Banana
            //6 Tangerine
            //7 Peacock
            //8 Graphite
            //9 Blueberry
            //10 Basil
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
