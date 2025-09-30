<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportUsers extends Model
{
    protected $fillable = ['email', 'status'];
}
