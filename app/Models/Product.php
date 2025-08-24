<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'tamil_name',
        'base_price',
        'selling_price',
        'packet_or_box',
        'quantity',
        'description',
        'slug',
        'items',
        'images',
    ];

    protected $casts = [
        'images' => 'array',  // automatically cast JSON to array and vice versa
    ];
}
