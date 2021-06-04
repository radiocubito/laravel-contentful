<?php

namespace Radiocubito\Wordful\Support;

use Illuminate\Config\Repository;
use Spatie\Valuestore\Valuestore;

class SiteConfiguration
{
    use HasIdentityImages;

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
        config()->set('site.logo_path', $this->valuestore->get('logo_path'));
        config()->set('site.logo_url', $this->getLogoUrlAttribute());
        config()->set('site.icon_path', $this->valuestore->get('icon_path'));
        config()->set('site.icon_url', $this->getIconUrlAttribute());

        ConfigCache::clear();
    }
}
