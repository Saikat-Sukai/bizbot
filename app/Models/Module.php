<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $guarded = [];

    // A module controls the update rights of certain tables
    protected $casts = [
        'tables_controlled' => 'array',
        'functions_contained' => 'array',
    ];

    // A module has functions
    public function functions()
    {
        return $this->hasMany(ModuleFunction::class, 'module_id');
    }

    // when context is loaded for a user, functions_controlled are filtered for permissions and provided as available_functions
    public function available_functions()
    {
        // for now, just return all functions
        return $this->hasMany(ModuleFunction::class, 'module_id');
    }

}
