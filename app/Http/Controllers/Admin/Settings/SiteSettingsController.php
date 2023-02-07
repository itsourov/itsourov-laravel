<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use app\Settings\SiteSettings;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function updateLogoSiteSettings(SiteSettings $settings, Request $request)
    {
        if ($request->hasFile('nav_logo')) {
            $request->validate([
                'nav_logo' => 'mimes:png',
            ]);

            $file = $request->file('nav_logo');

            $destinationPath = public_path() . '/images';
            $file->move($destinationPath, 'logo.png');
        }

        $formFields = $request->validate([
            'showLogoText' => ['boolean'],
        ]);

        $settings->showLogoText = $request->input('showLogoText') ?? false;

        $settings->save();

        return redirect()->back()->with('message', 'Settings updated');
    }

    public function updateGeneralSiteSettings(SiteSettings $settings, Request $request)
    {

        $formFields = $request->validate([
            'site_title' => ['required'],
            'site_tagline' => ['required'],
            'site_active' => ['boolean'],

        ]);
        $settings->site_title = $request->input('site_title');
        $settings->site_tagline = $request->input('site_tagline');
        $settings->site_active = $request->input('site_active') ?? false;

        $settings->save();

        return redirect()->back()->with('message', 'Settings updated');
    }
}