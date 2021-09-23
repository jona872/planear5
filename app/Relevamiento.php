<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relevamiento extends Model
{
    protected $table = 'relevamientos';
    protected $fillable = [
        'relevamiento_creator',
        // 'user_id',
        'tool_id',
        'relevamiento_latitud',
        'relevamiento_longitud'
    ];
}
