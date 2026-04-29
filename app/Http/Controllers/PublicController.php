<?php

namespace App\Http\Controllers;

use App\Models\Temple;
use App\Models\Hotel;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Song;

class PublicController extends Controller
{
    public function home()
    {
        $temples = Temple::latest()->take(6)->get();
        $homepageSongId = Setting::getValue('homepage_song_id');
        $homepageSong = $homepageSongId ? Song::find($homepageSongId) : null;

        $heroStatsMode = Setting::getValue('hero_stats_mode', 'text');
        $heroStatsImage = Setting::getValue('hero_stats_image');
        $statsTemples = Setting::getValue('stats_temples', '50+');
        $statsHotels = Setting::getValue('stats_hotels', '200+');
        $statsDevotees = Setting::getValue('stats_devotees', '10k+');
        $statsSupport = Setting::getValue('stats_support', '24/7');

        return view('public.home', compact(
            'temples', 
            'homepageSong', 
            'heroStatsMode', 
            'heroStatsImage', 
            'statsTemples', 
            'statsHotels', 
            'statsDevotees', 
            'statsSupport'
        ));
    }

    public function templeIndex(Request $request)
    {
        $search = $request->input('search');

        $temples = Temple::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('hotels', function ($hq) use ($search) {
                            $hq->where('name', 'like', "%{$search}%")
                                ->orWhere('details', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('public.temple_index', compact('temples', 'search'));
    }

    public function templeShow(Temple $temple)
    {
        $temple->load(['hotels', 'idleSong']);
        return view('public.temple_show', compact('temple'));
    }

    public function hotelShow(Hotel $hotel)
    {
        $hotel->load('temple');
        return view('public.hotel_show', compact('hotel'));
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->input('query');
        if (!$query)
            return response()->json([]);

        $temples = Temple::where('name', 'like', "%{$query}%")
            ->orWhere('location', 'like', "%{$query}%")
            ->take(5)
            ->get(['id', 'name', 'location', 'photos']);

        $hotels = Hotel::where('name', 'like', "%{$query}%")
            ->with('temple')
            ->take(3)
            ->get();

        $results = [];
        foreach ($temples as $temple) {
            $image = null;
            if ($temple->photos && count($temple->photos) > 0) {
                $photo = $temple->photos[0];
                $image = str_starts_with($photo, 'http') ? $photo : (str_starts_with($photo, 'assets/') ? asset($photo) : asset('storage/' . $photo));
            }

            $results[] = [
                'type' => 'temple',
                'title' => $temple->name,
                'subtitle' => $temple->location,
                'url' => route('public.temple.show', $temple),
                'image' => $image
            ];
        }

        foreach ($hotels as $hotel) {
            $image = null;
            if ($hotel->photos && count($hotel->photos) > 0) {
                $photo = $hotel->photos[0];
                $image = str_starts_with($photo, 'http') ? $photo : (str_starts_with($photo, 'assets/') ? asset($photo) : asset('storage/' . $photo));
            }

            $results[] = [
                'type' => 'hotel',
                'title' => $hotel->name,
                'subtitle' => 'Stay near ' . $hotel->temple->name,
                'url' => route('public.hotel.show', $hotel),
                'image' => $image
            ];
        }

        return response()->json($results);
    }
}
