<?php

namespace App\Http\Controllers;

use App\PokemonTrainerRepository;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function show(Request $request)
    {
        if($request->user())
        {
            $user_id = $request->user()->id;
            return $user_id;
        }
    }

    public function mark(Request $request)
    {
        if($request->user())
        {
            $user_id = $request->user()->id;
            $pokemon_id = $request->input('pokemon_id');

            if($pokemon_id === null)
            {
                return 404;
            }

            $repo = new PokemonTrainerRepository();
            return $repo->markPokemon($user_id, $pokemon_id);
        }
    }
}
