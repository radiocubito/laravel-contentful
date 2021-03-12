# Contentful

[![Latest Version on Packagist](https://img.shields.io/packagist/v/radiocubito/laravel-contentful.svg?style=flat-square)](https://packagist.org/packages/radiocubito/laravel-contentful)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/radiocubito/laravel-contentful/run-tests?label=tests)](https://github.com/radiocubito/laravel-contentful/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/radiocubito/laravel-contentful/Check%20&%20fix%20styling?label=code%20style)](https://github.com/radiocubito/laravel-contentful/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/radiocubito/laravel-contentful.svg?style=flat-square)](https://packagist.org/packages/radiocubito/laravel-contentful)


Just a simple blog package for Laravel.

## Installation

You can install the package via composer:

```bash
composer require radiocubito/laravel-contentful
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Radiocubito\Contentful\ContentfulServiceProvider" --tag="contentful-migrations"
php artisan migrate
```

You can publish the assets with:

```bash
php artisan vendor:publish --provider="Radiocubito\Contentful\ContentfulServiceProvider" --tag="contentful-assets"
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Radiocubito\Contentful\ContentfulServiceProvider" --tag="contentful-config"
```

## Usage

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Oliver Jimenez-Servin](https://github.com/oliverds)
- [All Contributors](../../contributors)

## License

The AGPL License (AGPL-3.0). Please see [License File](LICENSE.md) for more information.
