<?php

namespace App;

use App\User;

/*
Class to abstract the database representation of User aka our Trainer. Allows the controllers to not worry about how it's actually stored.
*/

class TrainerRepository
{
    //gives trainer id and email
    public function getTrainerByToken($api_token)
    {
        $user = User::where('api_token', $api_token)->get();
        $result = array(['trainer_id' => $user->id, 'name' => $user->email]);

        return $result;
    }
}
