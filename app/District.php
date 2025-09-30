<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'district_name','district_number','chairman_name','address_1','address_2','city','country','state',
      'zip','phone_number','email', 'zip_code_from', 'zip_code_to', 'active'
      
      ];
}
