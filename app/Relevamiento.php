<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relevamiento extends Model
{
    protected $table = 'relevamientos';
    protected $fillable = [
        'relevamiento_creator',
        'project_id',
        'tool_id',
        'user_id',
        'relevamiento_latitud',
        'relevamiento_longitud'
    ];
}
