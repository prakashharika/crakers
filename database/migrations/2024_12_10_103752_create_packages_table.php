<?php
// database/migrations/xxxx_xx_xx_create_packages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Basic, Professional, Premium
            $table->text('content');
            $table->decimal('price', 8, 2); // Price for the package
            $table->enum('price_type', ['month', 'year']); // Price per month or year
            $table->json('extra_features')->nullable(); // JSON for extra features
            $table->json('not_included')->nullable(); // JSON for features not included
            $table->json('property_listing_days')->nullable(); // JSON for property listing days
            $table->json('property_visibility_days')->nullable(); // JSON for visibility days
            $table->json('upto_images')->nullable(); // JSON for images
            $table->json('future_listing_days')->nullable(); // JSON for future listing days
            $table->json('upto_video')->nullable(); // JSON for video details
            $table->string('button_title')->nullable(); // Title for the button (optional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
