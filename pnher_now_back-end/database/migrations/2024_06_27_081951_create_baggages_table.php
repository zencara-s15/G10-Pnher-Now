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
        Schema::create('baggage', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('weight');
            $table->string('receiver_phone');
            $table->string('sending_address');
            $table->string('company');
            $table->string('receiving_address');
            $table->boolean('status');
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baggages');
    }
};
