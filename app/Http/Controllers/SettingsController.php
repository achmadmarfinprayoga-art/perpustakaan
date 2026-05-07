<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        if (isset($data['denda_harian'])) {
            $request->validate([
                'denda_harian' => 'required|integer|min:0',
            ]);
        }
        
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            $logoPath = $request->file('logo')->store('public/images');
            // Remove 'public/' from the path to store in db
            $data['logo'] = str_replace('public/', 'storage/', $logoPath);
        }
        
        if (isset($data['warna_utama'])) {
            $request->validate([
                'warna_utama' => 'required|string|max:7',
            ]);
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Seluruh pengaturan berhasil diperbarui!');
    }
}
