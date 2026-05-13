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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('req_no');
            $table->string('item_name');
            $table->string('item_subtitle')->nullable();
            $table->string('type'); // Pharmaceutical, Surgical, Non-surgical
            $table->integer('qty');
            $table->string('ordered_by');
            $table->string('ward_name'); // This is how we filter by Ward 1, Ward 2, etc.
            $table->string('status')->default('Pending');
            $table->date('date_ordered');
            $table->timestamps();
        });
    }
};