<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    //esto no sria un model con tabla, seria un model para administrar todo
    protected $table = 'home';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $dates = ['deleted_at'];

    protected $fillable = ['homePlz'];
}
