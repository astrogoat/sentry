<?php

namespace Astrogoat\Sentry;

use Exception;
use Helix\Lego\Apps\App;
use Helix\Lego\LegoManager;
use Illuminate\Routing\Router;
use Spatie\LaravelPackageTools\Package;
use Helix\Lego\Providers\RouteServiceProvider;
use Helix\Lego\Apps\Services\IncludeBackendViews;
use Helix\Lego\Apps\Services\IncludeFrontendViews;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Astrogoat\Sentry\Settings\SentrySettings;
use Astrogoat\Sentry\Middleware\AddAdditionalSentryInfo;

class SentryServiceProvider extends PackageServiceProvider
{
    public function registerApp(App $app)
    {
        return $app
            ->name('sentry')
            ->settings(SentrySettings::class)
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])
            ->includeFrontendViews(function (IncludeFrontendViews $frontendViews) {
                return $frontendViews->addToHead('sentry::frontend');
            })
            ->includeBackendViews(function (IncludeBackendViews $backendViews) {
                return $backendViews->addToHead('sentry::backend');
            })
            ->backendRoutes(__DIR__.'/../routes/backend.php')
            ->frontendRoutes(__DIR__.'/../routes/frontend.php');
    }

    public function registeringPackage()
    {
        $this->callAfterResolving('lego', function (LegoManager $lego) {
            $lego->registerApp(fn (App $app) => $this->registerApp($app));
        });
    }

    public function bootingPackage()
    {
        resolve(Router::class)->pushMiddlewareToGroup(RouteServiceProvider::MIDDLEWARE_GROUP_FRONTEND, AddAdditionalSentryInfo::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../public' => public_path('vendor/sentry/'),
            ], 'sentry-assets');
        }
    }

    public function configurePackage(Package $package): void
    {
        $package->name('sentry')->hasConfigFile()->hasViews();
    }
}
