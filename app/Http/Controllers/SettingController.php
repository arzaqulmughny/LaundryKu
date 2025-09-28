<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Show setting index page
     */
    public function index()
    {
        return view('pages.settings.index');
    }

    /**
     * Show edit page
     */
    public function edit(Setting $setting)
    {
        return view('pages.settings.edit', compact('setting'));
    }

    /**
     * Save updated setting
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        try {
            $this->settingRepository->update($setting, $request->toArray());
            return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil diupdate');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Reset specified setting
     */
    public function reset(Setting $setting) {
        try {
            $this->settingRepository->reset($setting);
            return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil direset');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Reset all settings
     */
    public function resetAll()
    {
        try {
            $this->settingRepository->resetAll();
            return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil direset');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
