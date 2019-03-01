<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
Model to describe a pokemon's type. Each pokemon can have 1 or more of these
*/

class Type extends Model
{
    public $timestamps = false; //don't require these two fields
}
