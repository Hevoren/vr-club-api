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
        Schema::create('vr_devices', function (Blueprint $table) {
            $table->increments('vr_device_id');
            $table->string('vr_glasses', 255);
            $table->string('controller', 255);
            $table->unsignedInteger('computer_id');
            $table->foreign('computer_id')->references('computer_id')->on('computers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vr_devices');
    }
};
