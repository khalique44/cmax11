<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalSetting extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'option_key','option_value'

    ];
}
