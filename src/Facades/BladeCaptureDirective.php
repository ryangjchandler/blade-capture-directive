<?php

namespace RyanChandler\BladeCaptureDirective\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RyanChandler\BladeCaptureDirective\BladeCaptureDirective
 */
class BladeCaptureDirective extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'blade-capture-directive';
    }
}
