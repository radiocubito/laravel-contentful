<?php

namespace Radiocubito\Wordful;

class Wordful
{
    public static $userModel = 'App\\Models\\User';

    public static function userModel()
    {
        return static::$userModel;
    }

    public static function newUserModel()
    {
        $model = static::userModel();

        return new $model;
    }

    public static function useUserModel(string $model)
    {
        static::$userModel = $model;

        return new static;
    }

    public static function hasAuthenticationFeature(): bool
    {
        return Features::hasAuthenticationFeature();
    }

    public static function managesSettings(): bool
    {
        return Features::managesSettings();
    }
}
