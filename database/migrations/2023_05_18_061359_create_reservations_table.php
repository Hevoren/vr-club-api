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
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('reservation_id');
            $table->dateTime('reservation_time');
            $table->integer('peoples');
            $table->unsignedInteger('game_id');
            $table->unsignedInteger('room_id');
            $table->foreign('game_id')->references('game_id')->on('games');
            $table->foreign('room_id')->references('room_id')->on('rooms');
            $table->integer('all_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
