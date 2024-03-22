<?php

namespace Astrogoat\Sentry\Settings;

use Helix\Lego\Settings\AppSettings;

class SentrySettings extends AppSettings
{
    public function description(): string
    {
        return 'Interact with Sentry.';
    }

    public static function group(): string
    {
        return 'sentry';
    }
}
