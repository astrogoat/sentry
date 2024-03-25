<?php

namespace Astrogoat\Sentry\Settings;

use Helix\Lego\Settings\AppSettings;

class SentrySettings extends AppSettings
{
    public function description(): string
    {
        return 'Don’t just observe. Take action. The only app monitoring platform built for developers that gets to the root cause for every issue.';
    }

    public static function group(): string
    {
        return 'sentry';
    }
}
