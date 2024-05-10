<?php

namespace Astrogoat\Sentry\Settings\Peripherals;

use Helix\Lego\Settings\Peripherals\Peripheral;

class CheckRequirements extends Peripheral
{
    public function requirements(): array
    {
        return [
            Requirement::make(title: 'DNS', failed: 'A DNS configuration must be defined in "config/sentry.php".')
                ->passesWhen(filled(config('sentry.dsn'))),
        ];
    }

    public function render()
    {
        return view('sentry::settings.peripherals.check-requirements');
    }
}
