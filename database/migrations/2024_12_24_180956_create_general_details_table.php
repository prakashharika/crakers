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
        Schema::create('general_details', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('instagram');
            $table->string('linkedin');
            $table->string('twitter');
            $table->string('facebook');
            $table->string('embaded');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_details');
    }
};
