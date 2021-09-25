<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'project_name',
        'city_id',
        'project_creator',
        'project_latitud',
        'project_longitud',
        'created_at'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d M Y h:i A');
    }
    
}
