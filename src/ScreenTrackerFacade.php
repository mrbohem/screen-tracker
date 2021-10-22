<?php

namespace Mrbohem\ScreenTracker;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mrbohem\ScreenTracker\ScreenTracker
 */
class ScreenTrackerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'screen-tracker';
    }
}
