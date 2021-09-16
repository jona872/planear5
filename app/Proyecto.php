<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $fillable = [
        'nombre',
        'id_ciudad',
        'id_creador',
        'latitud',
        'longitud',
        'created_at'
    ];
}
