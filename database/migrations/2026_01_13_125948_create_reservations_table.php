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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('set null');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->onDelete('set null');
            $table->foreignId('offer_id')->nullable()->constrained('offers')->onDelete('set null');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');

            $table->enum('status', [
                'new',
                'cancelled',
                'paid',
                'complete_treatment',
                'processing_in_treatment',
            ])->default('new');

            $table->dateTime('reservation_date')->nullable();
            $table->dateTime('next_appointment_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->enum('source', ['website', 'admin'])->default('admin');
            $table->text('notes')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
