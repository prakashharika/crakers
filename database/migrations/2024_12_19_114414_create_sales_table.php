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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->integer('pro_id')->nullable();
            $table->enum('isthiswhatsapp', ['on', 'off'])->nullable();
            $table->timestamps();  // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
