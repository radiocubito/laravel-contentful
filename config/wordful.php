<?php

use Radiocubito\Wordful\Http\Middleware\EnsureUserIsAuthorized;

return [

    /*
    |--------------------------------------------------------------------------
    | Wordful Dashboard Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Wordful Dashboard route - giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        EnsureUserIsAuthorized::class,
    ],

];
