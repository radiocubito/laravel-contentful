<?php

namespace Radiocubito\Wordful\Support;

use Illuminate\Config\Repository;
use Spatie\Valuestore\Valuestore;

class SiteConfiguration
{
    protected Valuestore $valuestore;

    protected Repository $config;

    public function __construct(
        Valuestore $valuestore,
        Repository $config
    ) {
        $this->valuestore = $valuestore;
        $this->config = $config;
    }

    public function put(array $values)
    {
        $this->valuestore->flush();

        return $this->valuestore->put($values);
    }

    public function all()
    {
        return $this->valuestore->all();
    }

    public function __get(string $property)
    {
        return $this->valuestore->get($property);
    }

    public function registerConfigValues()
    {
        config()->set('app.name', $this->valuestore->get('name', config('app.name')));
        config()->set('app.locale', $this->valuestore->get('locale', config('app.locale')));
        config()->set('app.timezone', $this->valuestore->get('timezone', config('app.timezone')));
        config()->set('site.name', $this->valuestore->get('name', config('app.name')));
        config()->set('site.description', $this->valuestore->get('description'));

        ConfigCache::clear();
    }
}
