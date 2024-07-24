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
        Schema::table('baggage', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable(); // Adjust 'existing_column' accordingly
            $table->decimal('longitude', 10, 7)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baggage', function (Blueprint $table) {
            //
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};
