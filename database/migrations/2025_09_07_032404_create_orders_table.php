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
       Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('order_id'); // e.g., ORD-202509071234
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->integer('quantity');
    $table->decimal('price', 10, 2);
    $table->string('payment_status')->default('pending'); // or 'paid'
   $table->foreignId('buyer_id')->constrained('buyers')->onDelete('cascade');
    $table->foreignId('address_id')->constrained('addresses')->onDelete('cascade');
    $table->timestamps(); // contains date
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
