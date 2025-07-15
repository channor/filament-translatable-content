<?php

namespace Channor\FilamentTranslatableContent;

use Channor\FilamentTranslatableContent\Commands\FilamentTranslatableContentCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentTranslatableContentServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-translatable-content')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament_translatable_content_table')
            ->hasCommand(FilamentTranslatableContentCommand::class);
    }
}
