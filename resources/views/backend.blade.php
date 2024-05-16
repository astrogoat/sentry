@php $settings = app(Astrogoat\Sentry\Settings\SentrySettings::class) @endphp
@if(
    app()->bound('sentry')
    && Astrogoat\Sentry\Settings\SentrySettings::isEnabled()
    && ($settings->capture_backend_javascript_errors === true || $settings->show_backend_report_widget === true)
)
    @php $user = auth()->user(); @endphp
    <script src="{{ asset('vendor/sentry/js/sentry.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Sentry.setUser({
                email: "{{ $user->email }}",
                fullName: "{{ $user->name }}",
            });

            Sentry.init({
                dsn: "{{ config('sentry.dsn') }}",
                environment: "{{ app()->environment() }}",

                integrations: [
                    @if($settings->show_backend_report_widget === true)
                        Sentry.feedbackIntegration({
                            // Additional SDK configuration goes in here, for example:
                            colorScheme: "system",
                            showName: false,
                            showEmail: false,
                            useSentryUser: {
                                email: "email",
                                name: "fullName",
                            },
                        }),
                    @endif

                    @if($settings->capture_backend_javascript_errors === true)
                        Sentry.browserTracingIntegration(),
                    @endif
                ],

                tracesSampleRate: {{ config('sentry.traces_sample_rate', 0.0) }},
            });
        });
    </script>
@endif
