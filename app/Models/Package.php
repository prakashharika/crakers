<?php
// app/Models/Package.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'content', 
        'price', 
        'price_type', 
        'extra_features', 
        'not_included', 
        'no_property_listing', 
        'property_visibility_days', 
        'upto_images', 
        'future_listing_days', 
        'upto_video', 
        'button_title',
        
    ];

    protected $casts = [
        'extra_features' => 'array',
        'not_included' => 'array',
    ];

    public function landOwner()
    {
        return $this->hasOne(LandOwner::class);
    }
}
