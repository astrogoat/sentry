<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sentry.capture_frontend_javascript_errors', false);
        $this->migrator->add('sentry.capture_backend_javascript_errors', false);
        $this->migrator->add('sentry.show_backend_report_widget', false);
    }

    public function down()
    {
        $this->migrator->delete('sentry.capture_frontend_javascript_errors');
        $this->migrator->delete('sentry.capture_backend_javascript_errors');
        $this->migrator->delete('sentry.show_backend_report_widget');
    }
};
