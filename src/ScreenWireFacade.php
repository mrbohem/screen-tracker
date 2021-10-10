<?php

namespace Mrbohem\ScreenWire;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mrbohem\ScreenWire\ScreenWire
 */
class ScreenWireFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'screen-wire';
    }
}
