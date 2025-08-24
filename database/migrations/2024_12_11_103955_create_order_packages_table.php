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
        Schema::create('order_packages', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('land_owner_id');
            $table->unsignedBigInteger('package_id'); 
            $table->foreign('land_owner_id')->references('id')->on('land_owners')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->string('title');
            $table->integer('price');
            $table->enum('price_type', ['month', 'anual']); 
            $table->integer('no_property');
            $table->integer('valid_days');
            $table->integer('upto_images');
            $table->integer('future_listing');
            $table->integer('upto_videos'); 
            $table->enum('payment_status', ['success', 'failed']); 
            $table->enum('status', ['active', 'inactive']);
            $table->date('expire_date');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_packages');
    }
};
