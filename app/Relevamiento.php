<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relevamiento extends Model
{
    protected $table = 'relevamientos';
    protected $fillable = [
        'nombre',
        'user_id',
        'tool_id'
    ];
}
