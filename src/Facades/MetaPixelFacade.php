<?php

namespace Rezkonline\LaravelMetaPixel\Facades;

use Illuminate\Support\Facades\Facade;

class MetaPixelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'meta.pixel';
    }
}