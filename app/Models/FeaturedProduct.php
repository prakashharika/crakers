<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeaturedProduct extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $except = [];
    protected $table = 'featured_products';
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
