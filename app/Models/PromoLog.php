<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoLog extends Model
{
    use HasFactory;

    protected $table = 'promo_code_log';

    protected $fillable = ['code_id', 'user_id', 'code'];
}
