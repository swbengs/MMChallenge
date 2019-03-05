<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
Class for egg groups. Each pokeman can have many groups
*/

class EggType extends Model
{
    public $timestamps = false; //don't require these two fields
}
