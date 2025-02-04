<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\Controllers\Storage;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        if (!auth()->user()->isAdmin()) {
            return redirect()->route('welcome')->with('error', 'You do not have permission to edit this place.');
        }
        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view('places.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('places', 'public');

        $place = new Place();
        $place->name = $validatedData['name'];
        $place->image = $imagePath;
        $place->save();

        return redirect()->route('places.create')->with('success', 'Place created successfully!');
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);
        if ($place->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->route('welcome')->with('error', 'You do not have permission to edit this place.');
        }

        return view('places.edit', compact('place'));
    }

    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);
        if ($place->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->route('welcome')->with('error', 'You do not have permission to edit this place.');
        }


        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('places', 'public');
            Storage::disk('public')->delete($place->image);
            $place->image = $imagePath;
        }

        $place->name = $validatedData['name'];
        $place->save();

        return redirect()->route('places.edit', $place->id)->with('success', 'Place edited successfully!');
    }



    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();
        return redirect()->route('places.index')->with('success', 'Place deleted successfully.');
    }
}
