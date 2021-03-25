<?php

namespace Radiocubito\Wordful\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    protected $signature = 'wordful:install';

    protected $description = 'Install all of the Wordful resources';

    public function handle()
    {
        $this->comment('Publishing Wordful Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'wordful-provider']);

        $this->comment('Publishing Wordful Migrations...');
        $this->callSilent('vendor:publish', ['--tag' => 'wordful-migrations']);

        $this->comment('Publishing Wordful Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'wordful-assets']);

        $this->registerWordfulServiceProvider();

        $this->info('Wordful scaffolding installed successfully.');
    }

    protected function registerWordfulServiceProvider()
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());

        $appConfig = file_get_contents(config_path('app.php'));

        if (Str::contains($appConfig, $namespace.'\\Providers\\WordfulServiceProvider::class')) {
            return;
        }

        $lineEndingCount = [
            "\r\n" => substr_count($appConfig, "\r\n"),
            "\r" => substr_count($appConfig, "\r"),
            "\n" => substr_count($appConfig, "\n"),
        ];

        $eol = array_keys($lineEndingCount, max($lineEndingCount))[0];

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\RouteServiceProvider::class,".$eol,
            "{$namespace}\\Providers\RouteServiceProvider::class,".$eol."        {$namespace}\Providers\WordfulServiceProvider::class,".$eol,
            $appConfig
        ));

        file_put_contents(app_path('Providers/WordfulServiceProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers/WordfulServiceProvider.php'))
        ));
    }
}
