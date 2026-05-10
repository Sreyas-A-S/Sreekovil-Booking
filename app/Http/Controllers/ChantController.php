<?php

namespace App\Http\Controllers;

use App\Models\Chant;
use Illuminate\Http\Request;

class ChantController extends Controller
{
    public function index(Request $request)
    {
        $chants = Chant::latest()->get();
        if ($request->ajax()) {
            return view('chants.partials.table', compact('chants'));
        }
        return view('chants.index', compact('chants'));
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            return view('chants.partials.form');
        }
        return view('chants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'meaning' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        Chant::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Chant added successfully.']);
        }

        return redirect()->route('admin.chants.index')->with('success', 'Chant added successfully.');
    }

    public function edit(Request $request, Chant $chant)
    {
        if ($request->ajax()) {
            return view('chants.partials.form', compact('chant'));
        }
        return view('chants.edit', compact('chant'));
    }

    public function update(Request $request, Chant $chant)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'meaning' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $chant->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Chant updated successfully.']);
        }

        return redirect()->route('admin.chants.index')->with('success', 'Chant updated successfully.');
    }

    public function destroy(Request $request, Chant $chant)
    {
        $chant->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Chant deleted successfully.']);
        }

        return redirect()->route('admin.chants.index')->with('success', 'Chant deleted successfully.');
    }
}
