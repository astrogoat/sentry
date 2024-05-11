<?php

namespace Astrogoat\Sentry\Settings;

use Helix\Lego\Settings\AppSettings;
use Helix\Lego\Apps\Requirement;

class SentrySettings extends AppSettings
{
    public function requirements(): array
    {
        return [
            new Requirement(
                title: 'Data Source Name (DNS)',
                passIf: filled(config('sentry.dsn')),
                failedMessage: 'A DNS configuration must be defined in "config/sentry.php".',
            ),
        ];
    }

    public function description(): string
    {
        return 'Don’t just observe. Take action. The only app monitoring platform built for developers that gets to the root cause for every issue.';
    }

    public static function group(): string
    {
        return 'sentry';
    }
}
