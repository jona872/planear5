<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['country_name'];

    public function province(){
        return $this->hasOne(Province::class);
    }
}
