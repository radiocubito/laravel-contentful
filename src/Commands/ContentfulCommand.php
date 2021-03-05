<?php

namespace Radiocubito\Contentful\Commands;

use Illuminate\Console\Command;

class ContentfulCommand extends Command
{
    public $signature = 'laravel-contentful';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
