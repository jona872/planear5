<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = [
        'nombre',
        'country_id'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
