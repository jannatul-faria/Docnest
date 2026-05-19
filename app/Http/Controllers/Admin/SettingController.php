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
            $path = upload_file($request->file('logo'), 'settings', 'public', get_setting('logo'));
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
            Cache::forget("setting.logo");
        }

        // Handle White Logo Upload
        if ($request->hasFile('logo_white')) {
            $path = upload_file($request->file('logo_white'), 'settings', 'public', get_setting('logo_white'));
            Setting::updateOrCreate(['key' => 'logo_white'], ['value' => $path]);
            Cache::forget("setting.logo_white");
        }

        // Handle Favicon Upload
        if ($request->hasFile('favicon')) {
            $path = upload_file($request->file('favicon'), 'settings', 'public', get_setting('favicon'));
            Setting::updateOrCreate(['key' => 'favicon'], ['value' => $path]);
            Cache::forget("setting.favicon");
        }

        return back()->with('success', 'Settings updated successfully!');
    }
}
