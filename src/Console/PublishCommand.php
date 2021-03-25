<?php

namespace Radiocubito\Wordful\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'wordful:publish {--force : Overwrite any existing files}';

    protected $description = 'Publish all of the Wordful resources';

    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'wordful-assets',
            '--force' => true,
        ]);
    }
}
