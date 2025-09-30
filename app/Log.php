<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['data','user_id'];
    protected $dates = ['created_at'];
}
