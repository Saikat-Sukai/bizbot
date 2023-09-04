<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'data' => 'array',
    ];

}
