<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolData extends Model
{
    protected $table = 'tools_data';
    protected $fillable = [
        'tool_id',
        'data_id'
    ];
}
