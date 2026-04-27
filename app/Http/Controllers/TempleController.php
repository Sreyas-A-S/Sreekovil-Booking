<?php

namespace App\Http\Controllers;

use App\Models\Temple;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TempleController extends Controller
{
    public function index(Request $request)
    {
        $temples = Temple::all();
        if ($request->ajax()) {
            return view('temples.partials.table', compact('temples'));
        }
        return view('temples.index', compact('temples'));
    }

    public function create(Request $request)
    {
        $songs = Song::all();
        if ($request->ajax()) {
            return view('temples.partials.form', compact('songs'));
        }
        return view('temples.create', compact('songs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'idle_song_id' => 'nullable|exists:songs,id',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240'
        ]);

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('temples', 'public');
                $photos[] = $path;
            }
        }

        $validated['photos'] = $photos;
        $temple = Temple::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Temple created successfully.']);
        }

        return redirect()->route('admin.temples.index')->with('success', 'Temple created successfully.');
    }

    public function show(Temple $temple)
    {
        $temple->load(['hotels', 'idleSong']);
        return view('temples.show', compact('temple'));
    }

    public function edit(Request $request, Temple $temple)
    {
        $songs = Song::all();
        if ($request->ajax()) {
            return view('temples.partials.form', compact('temple', 'songs'));
        }
        return view('temples.edit', compact('temple', 'songs'));
    }

    public function update(Request $request, Temple $temple)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'idle_song_id' => 'nullable|exists:songs,id',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240'
        ]);

        $photos = $temple->photos ?? [];

        // Handle photo removals
        if ($request->has('remove_photos')) {
            foreach ($request->remove_photos as $photoPath) {
                if (($key = array_search($photoPath, $photos)) !== false) {
                    unset($photos[$key]);
                    // Only delete from storage if it's not an external URL
                    if (!str_starts_with($photoPath, 'http')) {
                        Storage::disk('public')->delete($photoPath);
                    }
                }
            }
            $photos = array_values($photos); // Re-index array
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('temples', 'public');
                $photos[] = $path;
            }
        }

        $validated['photos'] = $photos;
        $temple->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Temple updated successfully.']);
        }

        return redirect()->route('admin.temples.index')->with('success', 'Temple updated successfully.');
    }

    public function destroy(Request $request, Temple $temple)
    {
        if ($temple->photos) {
            foreach ($temple->photos as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }
        $temple->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Temple deleted successfully.']);
        }

        return redirect()->route('admin.temples.index')->with('success', 'Temple deleted successfully.');
    }
}
