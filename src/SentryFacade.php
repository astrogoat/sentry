<?php

namespace Astrogoat\Sentry;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\Sentry\Sentry
 */
class SentryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sentry';
    }
}
