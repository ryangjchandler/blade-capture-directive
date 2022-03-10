<?php

namespace RyanChandler\BladeCaptureDirective\Commands;

use Illuminate\Console\Command;

class BladeCaptureDirectiveCommand extends Command
{
    public $signature = 'blade-capture-directive';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
