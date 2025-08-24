<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermsAndPolicy extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $except = [];
    protected $table = 'terms_and_policies';
}
