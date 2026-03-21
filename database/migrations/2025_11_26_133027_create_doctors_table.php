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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            
            $table->string('position')->nullable();
            $table->string('qualification')->nullable();
            $table->string('certifications')->nullable();
            $table->string('awards')->nullable();
            $table->string('photo')->nullable();
            $table->string('bio')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('set null');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
