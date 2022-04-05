<?php

namespace Swan\ArtisanModule;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Swan\ArtisanModule\Commands\ArtisanModuleCommand;
use Swan\ArtisanModule\Commands\ModuleListCommand;
use Swan\ArtisanModule\Commands\ModuleRouteListCommand;

class ArtisanModuleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('artisan-module')
            ->hasConfigFile()
            ->hasCommands(
                ModuleRouteListCommand::class,
                ModuleListCommand::class
            );
    }
}
