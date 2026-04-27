<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    public function index(Request $request)
    {
        $songs = Song::all();
        if ($request->ajax()) {
            return view('songs.partials.table', compact('songs'));
        }
        return view('songs.index', compact('songs'));
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            return view('songs.partials.form');
        }
        return view('songs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'singer' => 'nullable|string|max:255',
            'album' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'file' => 'required|file|mimes:mp3,wav,ogg|max:20480' // Max 20MB
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('songs', 'public');
            $validated['file_path'] = $path;
        }

        Song::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Song added to playlist successfully.']);
        }

        return redirect()->route('admin.songs.index')->with('success', 'Song added to playlist successfully.');
    }

    public function edit(Request $request, Song $song)
    {
        if ($request->ajax()) {
            return view('songs.partials.form', compact('song'));
        }
        return view('songs.edit', compact('song'));
    }

    public function update(Request $request, Song $song)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'singer' => 'nullable|string|max:255',
            'album' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:mp3,wav,ogg|max:20480'
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($song->file_path);
            $path = $request->file('file')->store('songs', 'public');
            $validated['file_path'] = $path;
        }

        $song->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Song updated successfully.']);
        }

        return redirect()->route('admin.songs.index')->with('success', 'Song updated successfully.');
    }

    public function destroy(Request $request, Song $song)
    {
        Storage::disk('public')->delete($song->file_path);
        $song->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Song deleted successfully.']);
        }

        return redirect()->route('admin.songs.index')->with('success', 'Song deleted successfully.');
    }
}
