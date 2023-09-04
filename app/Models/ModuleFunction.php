<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleFunction extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
