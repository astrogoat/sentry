@if(app()->bound('sentry') && Astrogoat\Sentry\Settings\SentrySettings::isEnabled())
    <script src="{{ asset('vendor/sentry/js/sentry.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Sentry.init({
                dsn: "{{ config('sentry.dsn') }}",
                environment: "{{ app()->environment() }}",

                integrations: [
                    Sentry.browserTracingIntegration(),
                ],

                tracesSampleRate: {{ config('sentry.traces_sample_rate', 0.0) }},
            });
        });
    </script>
@endif
