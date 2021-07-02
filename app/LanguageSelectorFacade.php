<?php

namespace App;

use Illuminate\Support\Facades\Facade;

class LanguageSelectorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LanguageSelector';
    }
}