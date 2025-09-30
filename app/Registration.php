<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
    	'first_name','middle_name','last_name','email','phone','password','dob','gender',
    	'dp','facebook_url','twitter_url', 'address_1', 'address_2', 'zip','country','last_mem',
    	'category','year','province','ack','status','is_verified','membership_token',
    	'name_on_card', 'address', 'city' , 'state', 'zip_code','card_num','expiration_date','csc_code',
    	'registration_Type','city_payment'
    ];
}
