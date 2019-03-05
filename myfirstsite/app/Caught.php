<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
Class for the pokemon that are caught. Links with user_id and pokemon_id
*/

class Caught extends Model
{
    public $timestamps = false; //don't require these two fields
}
