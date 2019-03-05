<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
Class for pokemon stats. Each stat is for one pokemon, and each pokemon only has one stat. this->id is the same as pokemon->id
*/

class Stat extends Model
{
    public $timestamps = false; //don't require these two fields
}
