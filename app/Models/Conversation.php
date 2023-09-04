<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $casts = [
        'final_json' => 'array',
        'assessment_steps' => 'array',
    ];
    protected $guarded = [];
    protected $hidden = ['assessment_steps', 'learning_priority'];
}
