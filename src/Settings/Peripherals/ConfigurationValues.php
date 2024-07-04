<?php

namespace Astrogoat\Sentry\Settings\Peripherals;

use Helix\Lego\Settings\Peripherals\Peripheral;

class ConfigurationValues extends Peripheral
{
    public function render()
    {
        return view('sentry::settings.peripherals.configuration-values');
    }
}
