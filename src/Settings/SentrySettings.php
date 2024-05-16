<?php

namespace Astrogoat\Sentry\Settings;

use Helix\Lego\Settings\AppSettings;
use Helix\Lego\Apps\Requirement;

class SentrySettings extends AppSettings
{
    public bool $capture_frontend_javascript_errors;
    public bool $capture_backend_javascript_errors;
    public bool $show_backend_report_widget;

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

    public function labels(): array
    {
        return [
            'capture_frontend_javascript_errors' => 'Capture frontend Javascript errors',
            'capture_backend_javascript_errors' => 'Capture backend Javascript errors',
        ];
    }

    public function sections(): array
    {
        return [
            [
                'title' => 'Error capturing',
                'properties' => [
                    'capture_frontend_javascript_errors',
                    'capture_backend_javascript_errors'
                ]
            ],
            [
                'title' => 'Bug reporting',
                'properties' => [
                    'show_backend_report_widget',
                ],
            ]
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
