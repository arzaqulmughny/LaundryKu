<?php

use App\Models\Setting;

if (!function_exists('appName')) {
    function appName()
    {
        $setting = Setting::where('key', 'application_name')->first();
        return $setting->value ?? $setting->default_value ?? "LaundryKu";
    }
}

if (!function_exists('appDesc')) {
    function appDesc()
    {
        $setting = Setting::where('key', 'application_desc')->first();
        return $setting->value ?? $setting->default_value ?? "Kelola bisnis landry dengan mudah";
    }
}

if (!function_exists('appIcon')) {
    function appIcon()
    {
        $setting = Setting::where('key', 'application_logo')->first();
        return $setting->value ? "storage/{$setting->value}" : "laundryku.png";
    }
}
