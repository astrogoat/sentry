<?php

namespace VendorName\Skeleton\Settings;

use Helix\Lego\Settings\AppSettings;

class SkeletonSettings extends AppSettings
{
    public function description(): string
    {
        return 'Interact with Skeleton.';
    }

    public static function group(): string
    {
        return 'skeleton';
    }
}
