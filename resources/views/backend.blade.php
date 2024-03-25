@if(app()->bound('sentry') && Astrogoat\Sentry\Settings\SentrySettings::isEnabled())
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

                beforeSend(event, hint) {
                    // Check if it is an exception, and if so, show the report dialog
                    if (event.exception && event.event_id) {
                        Sentry.showReportDialog({ eventId: event.event_id });
                    }

                    return event;
                },
                integrations: [
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

                    Sentry.browserTracingIntegration(),
                ],

                tracesSampleRate: {{ config('sentry.traces_sample_rate', 0.0) }},
            });
        });
    </script>
@endif
