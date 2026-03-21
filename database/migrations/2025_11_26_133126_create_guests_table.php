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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->enum('status', ['new', 'cancelled', 'paid'])->default('new');
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('set null');
            $table->foreignId('doctor_id')->nullable()->constrained('doctors')->onDelete('set null');
            $table->foreignId('offer_id')->nullable()->constrained('offers')->onDelete('set null');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->enum('source', ['website', 'admin'])->default('admin');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
