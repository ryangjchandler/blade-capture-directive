<?php

namespace RyanChandler\BladeCaptureDirective;

use RyanChandler\BladeCaptureDirective\Commands\BladeCaptureDirectiveCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BladeCaptureDirectiveServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('blade-capture-directive')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_blade-capture-directive_table')
            ->hasCommand(BladeCaptureDirectiveCommand::class);
    }
}
