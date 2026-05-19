<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

if (!function_exists('get_setting')) {
    /**
     * Get setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function get_setting($key, $default = null)
    {
        return Cache::rememberForever("setting.$key", function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }
}

if (!function_exists('upload_file')) {
    /**
     * Upload a file and optionally delete the old file.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param string $disk
     * @param string|null $oldPath
     * @return string
     */
    function upload_file(UploadedFile $file, string $folder = 'settings', string $disk = 'public', ?string $oldPath = null): string
    {
        if ($oldPath && Storage::disk($disk)->exists($oldPath)) {
            Storage::disk($disk)->delete($oldPath);
        }

        return $file->store($folder, $disk);
    }
}
