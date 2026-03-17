<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('products')->get();
        return response()->json($games);
    }

    public function show(Game $game)
    {
        $game->load('products.merchant');
        return response()->json($game);
    }
}

