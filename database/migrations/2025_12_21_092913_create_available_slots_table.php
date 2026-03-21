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
        Schema::create('available_slots', function (Blueprint $table) {
            $table->id();
            // Core data
            $table->string('day_name')->nullable(); // Saturday, Sunday.
            $table->unsignedBigInteger('day_of_week')->nullable(); // 1=Mon, ... 7=Sun
            $table->date('date')->nullable();

            //working hours
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            // $table->time('time')->nullable(); --- IGNORE ---
            $table->unsignedTinyInteger('max_bookings')->default(3); // default = 3 guests
            $table->unsignedTinyInteger('current_bookings')->default(0); // default = 0 guests

            // type of day or slot
            $table->enum('type',['normal','holiday','off','exception'])->default('normal');

            //status
            $table->boolean('is_active')->default(true);
            $table->boolean('is_blocked')->default(false);

            //note
            $table->string('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_slots');
    }
};
