<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
class LandOwner extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $except = [];
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'is_this_whatsapp',
        'city',
        'status',
    ];
    protected $table = 'land_owners';
    
    public function PropertiesList(): HasMany
    {
        return $this->hasMany(PropertiesList::class);
    }
    public function OrderPackage(): HasMany
    {
        return $this->hasMany(OrderPackage::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
