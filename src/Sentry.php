<?php

namespace Astrogoat\Sentry;

use Throwable;
use Sentry\State\Scope;
use GuzzleHttp\Exception\ClientException;
use Astrogoat\Sentry\Settings\SentrySettings;
use function Sentry\configureScope;

class Sentry
{
    public static function captureException(Throwable $throwable): void
    {
        if (tenancy()->initialized && SentrySettings::isEnabled()) {
            if ($throwable instanceof ClientException) {
                configureScope(function (Scope $scope) use ($throwable): void {
                    $scope->setContext('Guzzle', [
                        'response' => $throwable->getResponse()?->getBody()?->getContents() ?? 'Unknown',
                    ]);
                });
            }

            app('sentry')->captureException($throwable);
        }
    }
}
