<?php

namespace App;

use App\User;

/*
Class to abstract the database representation of User aka our Trainer. Allows the controllers to not worry about how it's actually stored.
*/

class PokemonRepository
{
    public function getUserByToken($api_token)
    {
        $user = User::where('api_token', $api_token)->get();
    }
}
