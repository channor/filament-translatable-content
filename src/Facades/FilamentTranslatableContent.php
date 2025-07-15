<?php

namespace Channor\FilamentTranslatableContent\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Channor\FilamentTranslatableContent\FilamentTranslatableContent
 */
class FilamentTranslatableContent extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Channor\FilamentTranslatableContent\FilamentTranslatableContent::class;
    }
}
