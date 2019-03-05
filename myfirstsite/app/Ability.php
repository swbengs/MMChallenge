<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
Class for pokemon abilities. Again, a pokemon can have many of these
*/

class Ability extends Model
{
    public $timestamps = false; //don't require these two fields
}
