<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $settings = $request->except(['_token', '_method', 'logo', 'favicon', 'logo_white']);

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            Cache::forget("setting.$key");
        }

        // Handle Logo Upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
            Cache::forget("setting.logo");
        }

        // Handle White Logo Upload
        if ($request->hasFile('logo_white')) {
            $path = $request->file('logo_white')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'logo_white'], ['value' => $path]);
            Cache::forget("setting.logo_white");
        }

        // Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'favicon'], ['value' => $path]);
            Cache::forget("setting.favicon");
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}
