<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
class Property extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image',  'tamil_name','description', 'sort_order', 'status',  'slug',];

    public function PropertiesList()
    {
        return $this->hasMany(PropertiesList::class)->orderBy('created_at', 'desc');
    }

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            $property->slug = Str::slug($property->name);
        });
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

}
