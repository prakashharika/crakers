<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'name',
        'phone',
        'address',
        'pincode'
    ];

    /**
     * Get the buyer that owns the address
     */
    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    /**
     * Get the orders for the address
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}