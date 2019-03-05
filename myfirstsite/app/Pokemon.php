<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
Main pokemon class. Only contains the fields which are static. id, name, height, weight, genus, and description
*/

class Pokemon extends Model
{
    //public $incrementing = false; //id will be supplised via CSV file so turn this off. Not anymore. increment does start at 1 so just use that
    public $timestamps = false; //don't require these two fields
}
