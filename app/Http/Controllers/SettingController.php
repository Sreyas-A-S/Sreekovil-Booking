<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Song;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $songs = Song::all();
        $homepageSongId = Setting::getValue('homepage_song_id');
        return view('settings.index', compact('songs', 'homepageSongId'));
    }

    public function update(Request $request)
    {
        Setting::updateOrCreate(
            ['key' => 'homepage_song_id'],
            ['value' => $request->homepage_song_id]
        );

        return back()->with('success', 'Settings updated successfully.');
    }
}
