<?php

namespace app\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{

    public string $site_title;

    public string $site_tagline;
    public bool $site_active;

    public bool $showLogoText;
    public static function group(): string
    {
        return 'general';
    }
}