<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PokemonRepository;

/*
Controller that will deal with entire pokemon table set. Will interface with PokemonRepository to do this.
*/

class PokemonController extends Controller
{
    public function show($id)
    {
        $pokemon = new PokemonRepository();
        return $pokemon->getPokemon($id);
        //return 200;
    }

    public function test()
    {
        return response()->json(['error' => 'resouce not found'], 404);
    }
}
