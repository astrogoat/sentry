<?php

namespace Astrogoat\Sentry\Middleware;

use Closure;
use Illuminate\Http\Request;
use Astrogoat\Sentry\Settings\SentrySettings;
use Symfony\Component\HttpFoundation\Response;

class AddAdditionalSentryInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->bound('sentry') && SentrySettings::isEnabled()) {
            \Sentry\configureScope(function (\Sentry\State\Scope $scope): void {
                $scope->setTag('tenant.name', tenant()->name ?? 'Central');
                $scope->setTag('tenant.id', tenant()->id ?? 'central');

                if (auth()->check()) {
                    $user = auth()->user();

                    $scope->setUser([
                        'id' => $user->id,
                        'username' => $user->name,
                        'email' => $user->email,
                        'strata_user_id' => strata_user_id(),
                    ]);
                } else {
                    $scope->setUser([
                        'id' => strata_user_id(),
                    ]);
                }
            });
        }

        return $next($request);
    }
}
