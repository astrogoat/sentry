<?php

namespace Astrogoat\Sentry\Settings;

use Illuminate\Validation\Rule;
use Helix\Lego\Settings\AppSettings;
use Helix\Lego\Apps\Requirement;
use Astrogoat\Sentry\Settings\Peripherals\ConfigurationValues;

class SentrySettings extends AppSettings
{
    public bool $enable_frontend_browser;
    public bool $enable_frontend_browser_tracing;
    public bool $enable_backend_browser;
    public bool $enable_backend_browser_tracing;
    public bool $show_backend_report_widget;

    protected array $peripherals = [
        ConfigurationValues::class,
    ];

    public function rules(): array
    {
        return [
            'enable_frontend_browser_tracing' => Rule::prohibitedIf(! $this->enable_frontend_browser),
            'enable_backend_browser_tracing' => Rule::prohibitedIf(! $this->enable_backend_browser),
            'show_backend_report_widget' => Rule::prohibitedIf(! $this->enable_backend_browser),
        ];
    }

    public function messages(): array
    {
        return [
            'enable_frontend_browser_tracing.prohibited' => 'Frontend browser extension must be enabled for tracing to be reported.',
            'enable_backend_browser_tracing.prohibited' => 'Backend browser extension must be enabled for tracing to be reported.',
            'show_backend_report_widget.prohibited' => 'Backend browser extension must be enabled for the report widget to be shown.',
        ];
    }

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
            'enable_frontend_browser' => 'Enable frontend browser integration',
            'enable_backend_browser' => 'Enable backend browser integration',
        ];
    }

    public function sections(): array
    {
        return [
            [
                'title' => 'Frontend Browser Integration',
                'properties' => [
                    'enable_frontend_browser',
                    'enable_frontend_browser_tracing',
                ]
            ],
            [
                'title' => 'Backend Browser Integration',
                'properties' => [
                    'enable_backend_browser',
                    'enable_backend_browser_tracing',
                    'show_backend_report_widget',
                ]
            ],
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
