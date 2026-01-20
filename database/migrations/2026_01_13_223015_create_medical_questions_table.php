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
        Schema::create('medical_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('medical_form_templates')->onDelete('cascade');
            $table->string('question');
            $table->enum('type', ['text', 'textarea', 'boolean', 'select', 'multiple_choice'])->default('text');
            $table->json('options')->nullable(); // for select/multiple_choice
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_questions');
    }
};
