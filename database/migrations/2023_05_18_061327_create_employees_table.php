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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('employee_id');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('status_id')->on('statuses');
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('mid_name', 255);
            $table->integer('salary');
            $table->string('title', 255);
            $table->string('phone_number', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
