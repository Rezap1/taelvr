<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    protected $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        // Get all settings and group them
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $input = $request->except(['_token', '_method']);
        
        foreach ($input as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting) {
                // If it's a file upload (logo, favicon, hero)
                if ($request->hasFile($key)) {
                    $media = $this->mediaService->upload($request->file($key), 'settings', str_replace('_', ' ', $key));
                    $setting->update(['value' => $media->file_path]);
                } else {
                    // Update normal text/textarea/boolean
                    // Handle boolean for checkboxes (if not present in request, set to 0)
                    if ($setting->type == 'boolean') {
                        $setting->update(['value' => $request->has($key) ? '1' : '0']);
                    } else {
                        // Don't override with null unless explicitly empty string
                        if ($value !== null) {
                            $setting->update(['value' => $value]);
                        }
                    }
                }
            }
        }

        // Handle boolean fields that might not be in request because they were unchecked
        $booleanSettings = Setting::where('type', 'boolean')->get();
        foreach ($booleanSettings as $boolSetting) {
            if (!$request->has($boolSetting->key)) {
                $boolSetting->update(['value' => '0']);
            }
        }

        // Clear settings cache if we are using it
        Cache::forget('website_settings');

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
