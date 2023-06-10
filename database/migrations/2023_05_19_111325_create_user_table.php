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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('login', 255);
            $table->string('password', 255);
            $table->string('email', 255);
            $table->unsignedInteger('role_id')->default(2);
            $table->foreign('role_id')->references('role_id')->on('roles');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->float('balls')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
