<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PropertiesList extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $except = [];
    protected $table = 'properties_lists';

    public function Property()
    {
        return $this->belongsTo(Property::class);
    }
    public function LandOwner(): BelongsTo
    {
        return $this->belongsTo(LandOwner::class);
    }

}
