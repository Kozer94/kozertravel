<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::orderBy('group')->orderBy('id')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $imageKeys = ['site_logo', 'site_favicon'];

        foreach (SiteSetting::all() as $setting) {
            if ($setting->type === 'image') {
                if ($request->hasFile($setting->key)) {
                    $request->validate([$setting->key => 'image|max:2048']);

                    // Delete old file
                    if ($setting->value) {
                        Storage::disk('public')->delete($setting->value);
                    }

                    $path = $request->file($setting->key)->store('settings', 'public');
                    $setting->update(['value' => $path]);
                }
            } else {
                if ($request->has($setting->key)) {
                    $setting->update(['value' => $request->input($setting->key)]);
                }
            }
        }

        SiteSetting::flushCache();

        return back()->with('success', 'تم حفظ الإعدادات بنجاح ✓');
    }
}
