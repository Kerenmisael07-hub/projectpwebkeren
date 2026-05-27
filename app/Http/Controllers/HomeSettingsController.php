<?php

namespace App\Http\Controllers;

use App\Support\HomeSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeSettingsController extends Controller
{
    public function edit(): View
    {
        return view('home-settings.edit', [
            'settings' => HomeSettings::load(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_badge' => ['sometimes', 'string', 'max:80'],
            'hero_title' => ['sometimes', 'string', 'max:180'],
            'hero_description' => ['sometimes', 'string', 'max:500'],
            'primary_cta_text' => ['sometimes', 'string', 'max:60'],
            'secondary_cta_text' => ['sometimes', 'string', 'max:60'],
            'section_intro_badge' => ['sometimes', 'string', 'max:80'],
            'section_intro_title' => ['sometimes', 'string', 'max:180'],
            'services_badge' => ['sometimes', 'string', 'max:80'],
            'services_title' => ['sometimes', 'string', 'max:180'],
            'vehicles_badge' => ['sometimes', 'string', 'max:80'],
            'vehicles_title' => ['sometimes', 'string', 'max:180'],
            'contact_badge' => ['sometimes', 'string', 'max:80'],
            'contact_title' => ['sometimes', 'string', 'max:180'],
            'contact_address' => ['sometimes', 'string', 'max:180'],
            'contact_whatsapp' => ['sometimes', 'string', 'max:30'],
            'contact_hours' => ['sometimes', 'string', 'max:80'],
            'footer_left' => ['sometimes', 'string', 'max:180'],
            'footer_right' => ['sometimes', 'string', 'max:180'],
        ]);

        $settings = array_merge(HomeSettings::load(), $validated);

        HomeSettings::save($settings);

        return redirect()->route('home-settings.edit')->with('success', 'Pengaturan home berhasil disimpan.');
    }
}