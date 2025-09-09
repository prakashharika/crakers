<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnSaleProduct extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $except = [];
    protected $table = 'on_sale_products';
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
