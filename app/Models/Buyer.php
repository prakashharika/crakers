<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Buyer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'city',
        'address',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the addresses for the buyer
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the orders for the buyer
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the default address for the buyer
     */
    public function defaultAddress()
    {
        return $this->hasOne(Address::class)->oldestOfMany();
    }
}