<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $except = [];
    protected $table = 'general_details';
}
