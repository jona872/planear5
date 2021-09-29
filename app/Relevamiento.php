<?php

namespace App;

use Carbon\Carbon;
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
        'relevamiento_longitud',
        'created_at',
    ];
    public $timestamps = false;
    
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }

        
    // public function getCreatedAtAttribute($date)
    // {
    //     return Carbon::parse($date)->format('d-m-Y');
    // }
}
