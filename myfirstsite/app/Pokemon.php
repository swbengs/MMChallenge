<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
Main pokemon class. Only contains the fields which are static
*/

class Pokemon extends Model
{
    //
    public $incrementing = false; //id will be supplised via CSV file so turn this off
    public $timestamps = false; //don't require these two fields
}
