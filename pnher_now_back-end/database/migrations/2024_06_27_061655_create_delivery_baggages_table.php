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
        Schema::create('delivery_baggage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baggage_id')->onDelete('cascade');
            $table->foreignId('deliverer_id')->constrained('users')->onDelete('cascade'); // Assuming 'deliverer_id' references the 'users' table
            $table->boolean('status')->nullable();
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_baggages');
    }
};
