<?php

namespace App;

use App\PokemonRepository;
use App\TrainerRepository;

/*
Class to abstract the database representation of both our trainer and pokemon. Allows the controllers to not worry about how it's actually stored.
This is for methods that interact with both trainers and pokemon. Methods that do both go in here
*/

class PokemonTrainerRepository
{
    //returns trainer name(email) and an array of pokemon id and names. These are the pokemon this trainer has caught. Requires trainer api_token
    public function getCaughtPokemon($api_token)
    {

    }

    //marks a given pokemon as caught for the trainer that matches the api_token
    public function markPokemon($api_token, $pokemon_id)
    {

    }
}
