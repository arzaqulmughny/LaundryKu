<?php

namespace App\Repositories;

use App\Models\Setting;

class SettingRepository
{
    public static array $settings = [
        [
            'key' => 'application_name',
            'label' => 'Nama Aplikasi',
            'default_value' => 'LaundryKu',
            'type' => 'text'
        ],
        [
            'key' => 'application_desc',
            'label' => 'Deskripsi Aplikasi',
            'default_value' => 'Kelola bisnis laundry dengan mudah',
            'type' => 'text'
        ],
        [
            'key' => 'application_logo',
            'label' => 'Logo Aplikasi',
            'default_value' => 'laundryku.png',
            'type' => 'file',
        ],
    ];

    /**
     * Update the specified setting
     */
    public function update(Setting $setting, array $data): bool
    {
        $type = $setting->type;

        if ($type == 'file') {
            $file = $data['value'];
            $path = $file->store('settings', 'public');

            $setting->update([
                'value' => $path
            ]);
        } else {
            $setting->fill($data);
        }

        $setting->save();

        return true;
    }

    /**
     * Reset specified setting
     */
    public function reset(Setting $setting): bool
    {
        $setting->update([
            'value' => null
        ]);

        return true;
    }

    /**
     * Reset all settings
     */
    public function resetAll(): bool
    {
        Setting::query()->update([
            'value' => null
        ]);

        return true;
    }
}
