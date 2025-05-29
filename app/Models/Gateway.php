<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    protected $fillable = [
        'nome',
        'url',
        'private_key',
        'public_key',
        'tax',
        'logo',
    ];
}
