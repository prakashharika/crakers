<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{ 
    //advertisements
    use HasFactory;
    protected $guarded = [];
    protected $except = [];
    protected $table = 'advertisements';
    public function property()
    {
        return $this->belongsTo(PropertiesList::class, 'property_id');
    }
    public function seller()
    {
        return $this->belongsTo(LandOwner::class, 'seller_id');
    }
}
