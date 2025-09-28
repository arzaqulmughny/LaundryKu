<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = collect(SettingRepository::$settings)->map((function ($setting) {
            return [
                'key' => $setting['key'],
                'label' => $setting['label'],
                'default_value' => $setting['default_value'],
                'type' => $setting['type'],
            ];
        }))->toArray();

        Setting::insert($settings);
    }
}
