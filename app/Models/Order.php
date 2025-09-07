<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'payment_status', 'user_id', 'address_id'];

}
