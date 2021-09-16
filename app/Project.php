<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'nombre',
        'city_id',
        'user_id',
        'latitud',
        'longitud',
        'created_at'
    ];
    
}
