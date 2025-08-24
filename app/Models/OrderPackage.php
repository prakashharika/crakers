<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderPackage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $except = [];
    protected $table = 'order_packages';
    public function LandOwner(): BelongsTo
    {
        return $this->belongsTo(LandOwner::class);
    }
}
