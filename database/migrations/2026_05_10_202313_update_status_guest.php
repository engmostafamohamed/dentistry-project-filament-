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
        // Drop old enum
        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Add new enum with updated values
        Schema::table('guests', function (Blueprint $table) {
            $table->enum('status', [
                'new',
                'continues',
                'cancelled',
                'completed',
            ])->default('new');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('guests', function (Blueprint $table) {
            $table->enum('status', ['new', 'cancelled', 'paid'])
                ->default('new');
        });
    }
};
