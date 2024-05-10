<?php

namespace Astrogoat\Sentry\Settings\Peripherals;

use Closure;

readonly class Requirement
{
    readonly bool|Closure $passes;

    public function __construct(public string $title, public string $failed)
    {
    }

    public static function make(string $title, string $failed)
    {
        return new Requirement($title, $failed);
    }

    public function passesWhen(bool|Closure $passes): static
    {
        $this->passes = $passes;

        return $this;
    }

    public function passed(): bool
    {
        if (is_callable($this->passes)) {
            return call_user_func($this->passes);
        }

        return $this->passes;
    }
}
