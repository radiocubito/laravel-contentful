<?php

namespace Radiocubito\Contentful;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Radiocubito\Contentful\Contentful
 */
class ContentfulFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-contentful';
    }
}
