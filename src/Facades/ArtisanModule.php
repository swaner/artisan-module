<?php

namespace Swan\ArtisanModule\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Swan\ArtisanModule\ArtisanModule
 */
class ArtisanModule extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'artisan-module';
    }
}
