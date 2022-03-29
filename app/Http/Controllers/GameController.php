<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //
    public function store()
    {
        $data = request()->validate([
            'game_id' => ['required'],
            'game_category' => ['required','string'],
            'kick_off_time' => ['required'],
            'home_team' => ['required','string'],
            'away_team' => ['required', 'string'],
            'odds_home' => ['required', 'numeric'],
            'odds_away' => ['required', 'numeric']
        ]);

        Game::create($data);

        return response()
                    ->json([
                        'message' => 'Games added succesfully'
                    ]);
    }

    public function index()
    {
        $data = Game::all();

        return response()
                    ->json([
                        'data' => $data
                    ]);
    }
}