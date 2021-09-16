<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectRelevamiento extends Model
{
    protected $table = 'projects_relevamientos';
    protected $fillable = [
        'nombre',
        'project_id',
        'relevamiento_id'
    ];
}
