<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $casts = [
        'created_at' => 'date:D d Y'
    ];
}
