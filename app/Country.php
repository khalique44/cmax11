<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['short_name', 'name','phone_code'];

    public function users()
    {
        return $this->hasMany(User::class,'country','id');
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
