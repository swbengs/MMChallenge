<?php

namespace App;

use App\PokemonRepository;
use App\TrainerRepository;
use App\Caught;

/*
Class to abstract the database representation of both our trainer and pokemon. Allows the controllers to not worry about how it's actually stored.
This is for methods that interact with both trainers and pokemon. Methods that do both go in here. Methods that modify caught table also go in here
*/

class PokemonTrainerRepository
{
    //returns trainer name(email) and an array of pokemon id and names. These are the pokemon this trainer has caught. Requires user id
    public function getCaughtPokemon($user_id)
    {
        $trainer_repo = new TrainerRepository();

        $trainer = $trainer_repo->getTrainerByID($user_id);
        if($trainer === NULL)
        {
            return 404;
        }

        $trainer['caught_list'] = $this->caughtPokemonList($user_id);
        return $trainer;
    }

    //method will make an array and add all caught pokemon id and names to it
    public function caughtPokemonList($trainer_id)
    {
        $result = array();
        $pokemon_repo = new PokemonRepository();

        $caught_collection = Caught::where('trainer_id', $trainer_id)->get();

        foreach($caught_collection as $caught)
        {
            $pokemon = $pokemon_repo->getPokemonOnly($caught->pokemon_id);
            array_push($result, array('id' => $pokemon['id'], 'name' => $pokemon['name']));
        }

        return $result;
    }

    //marks a given pokemon as caught for the trainer that matches the id
    public function markPokemon($user_id, $pokemon_id)
    {
        //find the trainer with given token. pass back 404 if no one has said token
        $trainer_repo = new TrainerRepository();
        $trainer = $trainer_repo->getTrainerByID($user_id);
        if($trainer === NULL)
        {
            return 404;
        }
        
        //var_dump($trainer);
        //check if already marked
        if(!$this->checkMarked($trainer['trainer_id'], $pokemon_id))
        {
            $caught = new Caught;
            $caught->trainer_id = $trainer['trainer_id'];
            $caught->pokemon_id = $pokemon_id;
            $caught->save();
        }
        
        return 200;
    }

    //method to check if this trainer has already marked this pokemon as marked. True if they have. false if not
    public function checkMarked($trainer_id, $pokemon_id)
    {
        $caught = Caught::where('trainer_id', $trainer_id)->where('pokemon_id', $pokemon_id)->get();

        if($caught->isEmpty())
        {
            //return var_dump($caught);
            return false;
        }
        else
        {
            //return var_dump($caught);
            return true;
        }
    }
}
