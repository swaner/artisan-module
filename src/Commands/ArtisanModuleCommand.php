<?php

namespace Swan\ArtisanModule\Commands;

use Illuminate\Console\Command;

class ArtisanModuleCommand extends Command
{
    public $signature = 'artisan-module';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
