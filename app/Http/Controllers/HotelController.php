<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Temple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $hotels = Hotel::with('temple')->get();
        $temples = Temple::all();
        if ($request->ajax()) {
            return view('hotels.partials.table', compact('hotels'));
        }
        return view('hotels.index', compact('hotels', 'temples'));
    }

    public function create(Request $request)
    {
        $temples = Temple::all();
        if ($request->ajax()) {
            return view('hotels.partials.form', compact('temples'));
        }
        return view('hotels.create', compact('temples'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'temple_id' => 'required|exists:temples,id',
            'name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'details' => 'nullable|string',
            'onwards_price' => 'required|numeric|min:0',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240'
        ]);

        $photos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('hotels', 'public');
                $photos[] = $path;
            }
        }

        $validated['photos'] = $photos;
        Hotel::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Hotel created successfully.']);
        }

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel created successfully.');
    }

    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    public function edit(Request $request, Hotel $hotel)
    {
        $temples = Temple::all();
        if ($request->ajax()) {
            return view('hotels.partials.form', compact('hotel', 'temples'));
        }
        return view('hotels.edit', compact('hotel', 'temples'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'temple_id' => 'required|exists:temples,id',
            'name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'details' => 'nullable|string',
            'onwards_price' => 'required|numeric|min:0',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240'
        ]);

        $photos = $hotel->photos ?? [];

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
                $path = $photo->store('hotels', 'public');
                $photos[] = $path;
            }
        }

        $validated['photos'] = $photos;
        $hotel->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Hotel updated successfully.']);
        }

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated successfully.');
    }

    public function destroy(Request $request, Hotel $hotel)
    {
        if ($hotel->photos) {
            foreach ($hotel->photos as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }
        $hotel->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Hotel deleted successfully.']);
        }

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel deleted successfully.');
    }
}
