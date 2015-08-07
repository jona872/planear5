<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $fillable = ['us_name', 'us_user', 'us_mail','us_adre', 'us_tele', 'photolink','password'];
    protected $hidden = ['password', 'remember_token'];
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $dates = ['deleted_at'];
    

 public function getAuthIdentifier()
 {
 return $this->getKey();
 }

 public function getAuthPassword()
 {
 return $this->password;
 }

 public function getReminderEmail()
 {
 return $this->email;
 }

}
