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
            return $user_id;
        }
    }
}
