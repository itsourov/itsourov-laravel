<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateSiteSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_title', 'Site Title');
        $this->migrator->add('general.site_tagline', 'Site Tagline');
        $this->migrator->add('general.site_active', true);
        $this->migrator->add('general.showLogoText', false);
    }
}