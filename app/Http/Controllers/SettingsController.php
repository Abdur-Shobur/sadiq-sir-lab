<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::getByGroup('general');
        return view('dashboard.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'footer_copyright' => 'required|string|max:255',
            'footer_description' => 'nullable|string|max:500',
            'contact_address' => 'nullable|string|max:500',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'contact_website' => 'nullable|url|max:255',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('settings', 'public');
            Setting::setValue('logo', $logoPath, 'image', 'general');
        }

        // Handle footer logo upload
        if ($request->hasFile('footer_logo')) {
            $footerLogoPath = $request->file('footer_logo')->store('settings', 'public');
            Setting::setValue('footer_logo', $footerLogoPath, 'image', 'general');
        }

        // Update text settings
        Setting::setValue('site_name', $request->site_name, 'text', 'general');
        Setting::setValue('site_description', $request->site_description, 'text', 'general');
        Setting::setValue('footer_copyright', $request->footer_copyright, 'text', 'general');
        Setting::setValue('footer_description', $request->footer_description, 'text', 'general');
        Setting::setValue('contact_address', $request->contact_address, 'text', 'general');
        Setting::setValue('contact_email', $request->contact_email, 'text', 'general');
        Setting::setValue('contact_phone', $request->contact_phone, 'text', 'general');
        Setting::setValue('contact_website', $request->contact_website, 'text', 'general');

        return redirect()->route('dashboard.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
