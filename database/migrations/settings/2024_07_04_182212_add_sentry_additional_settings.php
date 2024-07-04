<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sentry.enable_frontend_browser', false);
        $this->migrator->add('sentry.enable_backend_browser', false);
        $this->migrator->add('sentry.enable_frontend_browser_tracing', false);
        $this->migrator->add('sentry.enable_backend_browser_tracing', false);

        $this->migrator->delete('sentry.capture_frontend_javascript_errors');
        $this->migrator->delete('sentry.capture_backend_javascript_errors');
    }

    public function down()
    {
        $this->migrator->delete('sentry.enable_browser_frontend');
        $this->migrator->delete('sentry.enable_browser_backend');
        $this->migrator->delete('sentry.enable_frontend_browser_tracing');
        $this->migrator->delete('sentry.enable_backend_browser_tracing');
    }
};
