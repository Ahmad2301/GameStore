<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::withCount('products')->paginate(10);
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        return view('admin.games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('games', 'public');
        }

        Game::create($data);

        return redirect()->route('admin.games.index')->with('success', 'Game created');
    }

    public function edit(Game $game)
    {
        return view('admin.games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('games', 'public');
        }

        $game->update($data);

        return redirect()->route('admin.games.index')->with('success', 'Game updated');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Game deleted');
    }
}

