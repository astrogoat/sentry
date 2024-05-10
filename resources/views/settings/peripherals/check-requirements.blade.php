@push('styles')
    <link rel="stylesheet" href="{{ mix('css/backend.css', 'vendor/sentry') }}">
@endpush

<x-fab::lists.two-column title="Requirements for extension to function correctly">
    <ul role="list" class="sentry-divide-y sentry-divide-gray/5">
        @foreach($this->requirements() as $requirement)
            <li class="sentry-relative sentry-flex sentry-items-center sentry-space-x-4 sentry-p-4">
                <div class="sentry-min-w-0 sentry-flex-auto">
                    <div class="sentry-flex sentry-items-center sentry-gap-x-3">
                        <div class="sentry-flex-none sentry-rounded-full sentry-p-1 {{ $requirement->passed() ? 'sentry-text-green-500' : 'sentry-text-red-500' }} sentry-bg-gray-100/10">
                            <div class="sentry-h-2 sentry-w-2 sentry-rounded-full sentry-bg-current"></div>
                        </div>
                        <h2 class="sentry-min-w-0 sentry-text-sm sentry-font-semibold sentry-leading-6 sentry-text-gray-700">
                            <span class="sentry-truncate">{{ $requirement->title }}</span>
                        </h2>
                    </div>
                    @unless($requirement->passed())
                        <div class="sentry-flex sentry-items-center sentry-gap-x-2.5 sentry-text-xs sentry-leading-5 sentry-text-gray-400">
                            <p class="sentry-truncate">{{ $requirement->failed }}</p>
                        </div>
                    @endunless
                </div>
            </li>
        @endforeach
    </ul>
</x-fab::lists.two-column>
