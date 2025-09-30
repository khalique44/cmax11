<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['country_id', 'name'];

    public function users()
    {
        return $this->hasMany(User::class,'state','id');
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
