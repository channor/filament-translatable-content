<?php

namespace Channor\FilamentTranslatableContent\Commands;

use Illuminate\Console\Command;

class FilamentTranslatableContentCommand extends Command
{
    public $signature = 'filament-translatable-content';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
