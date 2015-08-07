<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $table = 'profile';
    protected $primaryKey = 'id';
    protected $fillable = ['name','fk','fk_user'];
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $dates = ['deleted_at'];
	


}
