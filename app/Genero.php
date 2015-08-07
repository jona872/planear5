<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
   protected $table = 'genero';
  	protected $primaryKey = 'id';
    protected $fillable = ['genre'];
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $dates = ['deleted_at'];
    
}
