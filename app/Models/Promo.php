<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promo_code';

    protected $fillable = ['code', 'discount', 'max_use', 'expired_at'];
}
