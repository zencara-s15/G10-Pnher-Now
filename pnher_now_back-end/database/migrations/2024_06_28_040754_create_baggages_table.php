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
            $table->integer('weight');
            $table->string('receiver_phone');
            $table->string('sending_address');
            $table->string('company');
            $table->string('receiving_address');
            $table->boolean('status');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('delivery_status_id');

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('delivery_status_id')->references('id')->on('delivery_status')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down() 
    {
        Schema::table('baggage', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['delivery_status_id']);
        });

        Schema::dropIfExists('baggage');
    }
};
