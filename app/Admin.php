<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
	
    use Notifiable;

     protected $fillable = ['email','name','password','user_id'];
}
