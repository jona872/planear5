<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $table = 'tools';
    protected $fillable = [
        'tool_name',
        'user_id'
    ];
}
