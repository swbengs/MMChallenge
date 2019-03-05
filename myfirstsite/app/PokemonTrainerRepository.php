<?php

namespace App;

use App\PokemonRepository;
use App\TrainerRepository;

/*
Class to abstract the database representation of both our trainer and pokemon. Allows the controllers to not worry about how it's actually stored.
This is for methods that interact with both trainers and pokemon. Methods that do both go in here. Methods that modify caught table also go in here
*/

class PokemonTrainerRepository
{
    //returns trainer name(email) and an array of pokemon id and names. These are the pokemon this trainer has caught. Requires user id
    public function getCaughtPokemon($user_id)
    {
        $pokemon_repo = PokemonRepository();
    }

    //marks a given pokemon as caught for the trainer that matches the id
    public function markPokemon($user_id, $pokemon_id)
    {
        //find the trainer with given token. pass back 404 if no one has said token
        $trainer_repo = TrainerRepository();
        $trainer = $trainer_repo->getTrainerByToken($api_token);
        if($trainer === NULL)
        {
            return 404;
        }
        
    }
}
