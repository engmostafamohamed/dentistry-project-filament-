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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->onDelete('cascade');
            $table->string('key')->nullable(); // optional unique key (like 'hero', 'team')
            $table->string('type')->default('custom'); // hero, team, points, doctor, etc.

            // Translatable fields
            $table->json('header')->nullable();
            $table->json('title')->nullable();
            $table->json('description')->nullable();

            // Structured data
            $table->json('images')->nullable();
            $table->json('points')->nullable();
            $table->json('members')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
