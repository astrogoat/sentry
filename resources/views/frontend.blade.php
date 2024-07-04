@php
    $settings = app(Astrogoat\Sentry\Settings\SentrySettings::class)
@endphp
@if(app()->bound('sentry') && $settings->enabled && $settings->enable_frontend_browser === true)
    <script src="{{ asset('vendor/sentry/js/sentry.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Sentry.init({
                dsn: "{{ config('sentry.dsn') }}",
                environment: "{{ app()->environment() }}",

                integrations: [
                    @if($settings->enable_frontend_browser_tracing === true)
                        Sentry.browserTracingIntegration(),
                    @endif
                ],

                tracesSampleRate: {{ config('sentry.traces_sample_rate', 0.0) }},
            });
        });
    </script>
@endif
