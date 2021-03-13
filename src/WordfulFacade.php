<?php

namespace Radiocubito\Wordful;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Radiocubito\Wordful\Wordful
 */
class WordfulFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-wordful';
    }
}
