<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   use HasFactory;

   protected $fillable = [
      'order_id',
      'product_id',
      'quantity',
      'price',
      'payment_status',
      'buyer_id',
      'address_id'
   ];

   /**
    * Get the product that owns the order
    */
   public function product()
   {
      return $this->belongsTo(Product::class);
   }

   /**
    * Get the address associated with the order
    */
   public function address()
   {
      return $this->belongsTo(Address::class);
   }

   /**
    * Get the buyer who placed the order
    */
   public function buyer()
   {
      return $this->belongsTo(Buyer::class);
   }
}