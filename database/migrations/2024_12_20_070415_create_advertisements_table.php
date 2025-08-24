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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id'); 
            $table->unsignedBigInteger('seller_id'); 
            $table->string('ad_image');
            $table->foreign('property_id')->references('id')->on('properties_lists')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('land_owners')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
