<?php

namespace App;

use App\Pokemon;
use App\Type;
//use Illuminate\Database\Eloquent\Model;

/*

*/

class PokemonRepository
{
    public function getPokemon($id)
    {
        $pokemon = Pokemon::find($id);
        $type = Type::find($id);

        return $pokemon;
    }
}
