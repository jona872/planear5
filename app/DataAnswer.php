<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataAnswer extends Model
{
    protected $table = 'data_answers';
    protected $fillable = [
        'data_id',
        'answer_id',
        'relevamiento_id'
    ];
}
