@if(
    app()->bound('sentry')
    && Astrogoat\Sentry\Settings\SentrySettings::isEnabled()
    && app(Astrogoat\Sentry\Settings\SentrySettings::class)->capture_frontend_javascript_errors === true
)
    <script src="{{ asset('vendor/sentry/js/sentry.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Sentry.init({
                dsn: "{{ config('sentry.dsn') }}",
                environment: "{{ app()->environment() }}",

                integrations: [
                    @if($settings->capture_frontend_javascript_errors === true)
                        Sentry.browserTracingIntegration(),
                    @endif
                ],

                tracesSampleRate: {{ config('sentry.traces_sample_rate', 0.0) }},
            });
        });
    </script>
@endif
