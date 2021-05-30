<?php

namespace Radiocubito\Wordful\Tests;

trait SettingsFeatureEnabled
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);

        $app['config']->set('wordful.features', ['settings']);
    }
}
