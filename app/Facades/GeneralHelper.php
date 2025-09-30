<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GeneralHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Http\Helpers\GeneralHelper::class;
    }
}