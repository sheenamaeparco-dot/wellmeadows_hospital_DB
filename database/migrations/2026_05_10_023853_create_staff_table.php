<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {

            $table->id('staff_number');

            $table->integer('role_id');

            $table->string('email')->unique();

            $table->string('password');

            $table->string('first_name');

            $table->string('last_name');

            $table->string('position');

            $table->string('sex');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};