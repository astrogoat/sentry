@php
    $settings = app(Astrogoat\Sentry\Settings\SentrySettings::class)
@endphp
@if(app()->bound('sentry') && $settings->enabled && $settings->enable_backend_browser === true)
    <style>
        #sentry-feedback {
            /* Put the button under the media library overlay as it covers the "Insert" button */
            --z-index: 49;
        }
    </style>

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

                    @if($settings->enable_backend_browser_tracing === true)
                        Sentry.browserTracingIntegration(),
                    @endif
                ],

                tracesSampleRate: {{ config('sentry.traces_sample_rate', 0.0) }},
            });
        });
    </script>
@endif
