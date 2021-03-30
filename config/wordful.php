<?php

use Radiocubito\Wordful\Features;
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

    /*
    |--------------------------------------------------------------------------
    | Wordful Subscribers Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Wordful subscribers route - giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'subscribers-middleware' => [
        'web',
        'signed',
    ],

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Some of the Marketplaceful features are optional. You may disable the features
    | by removing them from this array.
    |
    */

    'features' => [
        // Features::authentication(),
    ],

];
