<?php

namespace Astrogoat\Sentry\Settings;

use Helix\Lego\Settings\AppSettings;
use Astrogoat\Sentry\Settings\Peripherals\CheckRequirements;

class SentrySettings extends AppSettings
{
    protected array $peripherals = [
        CheckRequirements::class,
    ];

    public function description(): string
    {
        return 'Don’t just observe. Take action. The only app monitoring platform built for developers that gets to the root cause for every issue.';
    }

    public static function group(): string
    {
        return 'sentry';
    }
}
