<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('baggage', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('weight');
            $table->text('receiver_phone');
            $table->text('sending_address');
            $table->text('receiver_address');
            $table->integer('post_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baggage');
    }
};
