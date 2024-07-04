<x-fab::lists.table title="Configuration values" description="These values can only be changed by the development team.">
    <x-fab::lists.table.header>Name</x-fab::lists.table.header>
    <x-fab::lists.table.header>Value</x-fab::lists.table.header>

    <x-fab::lists.table.row odd>
        <x-fab::lists.table.column>Environment</x-fab::lists.table.column>
        <x-fab::lists.table.column>{{ config('sentry.environment') ?: config('app.env') }}</x-fab::lists.table.column>
    </x-fab::lists.table.row>

    <x-fab::lists.table.row>
        <x-fab::lists.table.column>Trace Sample Rate</x-fab::lists.table.column>
        <x-fab::lists.table.column>{{ config('sentry.traces_sample_rate') * 100 }}%</x-fab::lists.table.column>
    </x-fab::lists.table.row>

    <x-fab::lists.table.row odd>
        <x-fab::lists.table.column>Queue Job Tracing Transactions</x-fab::lists.table.column>
        <x-fab::lists.table.column>{{ config('sentry.tracing.queue_job_transactions') ? 'Yes' : 'No' }}</x-fab::lists.table.column>
    </x-fab::lists.table.row>

    <x-fab::lists.table.row>
        <x-fab::lists.table.column>Profiles Sample Rate</x-fab::lists.table.column>
        <x-fab::lists.table.column>{{ config('sentry.profiles_sample_rate') * 100 }}%</x-fab::lists.table.column>
    </x-fab::lists.table.row>

    <x-fab::lists.table.row odd>
        <x-fab::lists.table.column>Send Default PII</x-fab::lists.table.column>
        <x-fab::lists.table.column>{{ config('sentry.send_default_pii') ? 'Yes' : 'No' }}</x-fab::lists.table.column>
    </x-fab::lists.table.row>

    <x-fab::lists.table.row>
        <x-fab::lists.table.column>Attach Metric Code Locations</x-fab::lists.table.column>
        <x-fab::lists.table.column>{{ config('sentry.attach_metric_code_locations') ? 'Yes' : 'No' }}</x-fab::lists.table.column>
    </x-fab::lists.table.row>

</x-fab::lists.table>
