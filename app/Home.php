<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    //
    protected $table = 'home';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $dates = ['deleted_at'];

    protected $fillable = ['homePlz'];
}
