<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'event';
  	protected $primaryKey = 'id';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $dates = ['deleted_at'];
    protected $fillable = ['event_name','event_owner','event_desc','event_date','event_type','event_loca','event_priv'];
}
