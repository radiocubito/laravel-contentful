<?php

namespace Radiocubito\Wordful;

class Features
{
    public static function enabled(string $feature): bool
    {
        return in_array($feature, config('wordful.features', []));
    }

    public static function optionEnabled(string $feature, string $option): bool
    {
        return static::enabled($feature) &&
               config("wordful-options.{$feature}.{$option}") === true;
    }

    public static function hasAuthenticationFeature(): bool
    {
        return static::enabled(static::authentication());
    }

    public static function authentication(): string
    {
        return 'authentication';
    }
}
