<?php

namespace Radiocubito\Wordful;

class Features
{
    public static function enabled(string $feature)
    {
        return in_array($feature, config('wordful.features', []));
    }

    public static function optionEnabled(string $feature, string $option)
    {
        return static::enabled($feature) &&
               config("wordful-options.{$feature}.{$option}") === true;
    }

    public static function hasAuthenticationFeature()
    {
        return static::enabled(static::authentication());
    }

    public static function authentication()
    {
        return 'authentication';
    }
}
