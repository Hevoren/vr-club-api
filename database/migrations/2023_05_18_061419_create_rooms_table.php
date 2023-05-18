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
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('room_id');
            $table->string('type_room', 255);
            $table->unsignedInteger('vr_device_id');
            $table->unsignedInteger('employee_id');
            $table->foreign('vr_device_id')->references('vr_device_id')->on('vr_devices');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->integer('price');
            $table->string('role', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
