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
        $heroStatsMode = Setting::getValue('hero_stats_mode', 'text');
        $heroStatsImage = Setting::getValue('hero_stats_image');
        $statsTemples = Setting::getValue('stats_temples', '50+');
        $statsHotels = Setting::getValue('stats_hotels', '200+');
        $statsDevotees = Setting::getValue('stats_devotees', '10k+');
        $statsSupport = Setting::getValue('stats_support', '24/7');

        return view('settings.index', compact(
            'songs', 
            'homepageSongId', 
            'heroStatsMode', 
            'heroStatsImage', 
            'statsTemples', 
            'statsHotels', 
            'statsDevotees', 
            'statsSupport'
        ));
    }

    public function update(Request $request)
    {
        // Homepage Song
        Setting::updateOrCreate(['key' => 'homepage_song_id'], ['value' => $request->homepage_song_id]);

        // Hero Stats Mode
        Setting::updateOrCreate(['key' => 'hero_stats_mode'], ['value' => $request->hero_stats_mode]);

        // Hero Stats Text
        Setting::updateOrCreate(['key' => 'stats_temples'], ['value' => $request->stats_temples]);
        Setting::updateOrCreate(['key' => 'stats_hotels'], ['value' => $request->stats_hotels]);
        Setting::updateOrCreate(['key' => 'stats_devotees'], ['value' => $request->stats_devotees]);
        Setting::updateOrCreate(['key' => 'stats_support'], ['value' => $request->stats_support]);

        // Hero Stats Image
        if ($request->hasFile('hero_stats_image')) {
            $path = $request->file('hero_stats_image')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'hero_stats_image'], ['value' => $path]);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
