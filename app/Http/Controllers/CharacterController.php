<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $characters = Character::all();
        } else {
            $user = Auth::user();
            $characters = $user->characters;
        }

        return view('characters.index', ['characters' => $characters]);
    }

    public function show($id)
    {
        $character = Character::findOrFail($id);
        return view('characters.show', compact('character'));
    }

    public function edit($id)
    {
        $character = Character::findOrFail($id);
        $isAdmin = auth()->user()->isAdmin();

        if ($character->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'You do not have permission to edit this character.');
        }

        return view('characters.edit', compact('character', 'isAdmin'));
    }

    public function update(Request $request, $id)
    {
        $character = Character::findOrFail($id);

        if ($character->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'You do not have permission to edit this character.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'defence' => 'required|integer|min:0|max:3',
            'strength' => 'required|integer|min:0|max:20',
            'accuracy' => 'required|integer|min:0|max:20',
            'magic' => 'required|integer|min:0|max:20',
            'enemy' => 'nullable|boolean',
        ]);

        $enemy = $request->has('enemy') ? 1 : 0;

        $character->update(array_merge($validatedData, ['enemy' => $enemy]));

        return redirect()->route('characters.show', $character->id)->with('success', 'Character updated successfully.');
    }

    public function destroy($id)
    {
        $character = Character::findOrFail($id);

        if ($character->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'You do not have permission to delete this character.');
        }

        $character->delete();

        return redirect()->route('characters.index')->with('success', 'Character deleted successfully.');
    }

    public function create()
    {
        return view('characters.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'defence' => 'required|integer|min:0|max:3',
            'strength' => 'required|integer|min:0|max:20',
            'accuracy' => 'required|integer|min:0|max:20',
            'magic' => 'required|integer|min:0|max:20',
        ]);

        $totalPoints = $validatedData['defence'] + $validatedData['strength'] + $validatedData['accuracy'] + $validatedData['magic'];
        if ($totalPoints > 20) {
            return redirect()->back()->withInput()->with('error', 'The total attribute points must be 20.');
        }

        $validatedData['enemy'] = false;

        $user_id = auth()->id();

        $character = Character::create(array_merge($validatedData, ['user_id' => $user_id]));

        if (auth()->user()->isAdmin()) {
            if ($request->has('enemy')) {
                $character->enemy = true;
                $character->save();
            }
        }

        return redirect()->route('characters.show', $character->id)->with('success', 'Character created successfully.');
    }
}
