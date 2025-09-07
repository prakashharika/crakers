<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
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
    public function category()
    {
        return $this->belongsTo(Property::class, 'category_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
