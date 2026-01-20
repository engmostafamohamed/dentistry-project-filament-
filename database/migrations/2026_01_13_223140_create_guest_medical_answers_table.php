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
        Schema::create('guest_medical_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
            $table->foreignId('medical_question_id')->constrained('medical_questions')->onDelete('cascade');
            $table->foreignId('form_link_id')->constrained('guest_medical_form_links')->onDelete('cascade');
            $table->text('answer')->nullable();
            $table->text('dentist_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_medical_answers');
    }
};
