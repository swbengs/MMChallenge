<?php

namespace App;

use App\Ability;
use App\EggType;
use App\Pokemon;
use App\Stat;
use App\Type;
//use Illuminate\Database\Eloquent\Model;

/*

*/

class PokemonRepository
{
    public function getPokemon($id)
    {
        $pokemon = Pokemon::find($id);
        //$type = Type::find($id);

        return $pokemon;
    }

    public function setPokemon($id, $name, $types, $height, $weight, $abilties, $egg_groups, $stats, $genus, $description)
    {
        $pokemon = new Pokemon;
        $pokemon->id = $id; //might not be required
        $pokemon->name = $name;
        $pokemon->height = $height;
        $pokemon->weight = $weight;
        $pokemon->genus = $genus;
        $pokemon->description = $description;
        $pokemon->save();

        foreach($abilties as $value)
        {
            $ability = new Ability;
            $ability->pokemon_id = $id;
            $ability->ability = $value;
            $ability->save();
        }

        foreach($egg_groups as $value)
        {
            $egg_type = new EggType;
            $egg_type->pokemon_id = $id;
            $egg_type->egg_type = $value;
            $egg_type->save();
        }

        foreach($types as $value)
        {
            $type = new Type;
            $type->pokemon_id = $id;
            $type->type = $value;
            $type->save(); //don't forget to save to database ;)
        }
    }

    public function setup()
    {
        $file = fopen(storage_path('app/pokedex.csv'), 'r');
        fgetcsv($file); //first line is just the column names and we can safely skip those

        while(!feof($file))
        {
            //one line at a time
            //Array ( [0] => id [1] => name [2] => types [3] => height [4] => weight [5] => abilities [6] => egg_groups [7] => stats [8] => genus [9] => description )
            $data = fgetcsv($file);
            
            $id = $data[0];
            $name = $data[1];
            $types = json_decode($data[2]);
            $height = $data[3];
            $weight = $data[4];
            $abilties = json_decode($data[5]);
            $egg_groups = json_decode($data[6]);
            $stats = $data[7];
            $genus = $data[8];
            $description = $data[9];
            //print($id . ' ' . $name . ',');
            //var_dump($types);
            
            if($id === NULL) //quick and dirty safety check. Should make sure all values are good before calling setPokemon
            {
                continue;
            }
            else
            {
                $this->setPokemon($id, $name, $types, $height, $weight, $abilties, $egg_groups, $stats, $genus, $description);
            }
            
        }
        return 200; //if we reach here it worked
    }

    public function csvTest()
    {
        $file = fopen(storage_path('app/pokedex.csv'), 'r');
        while(!feof($file))
        {
            //one line at a time
            //each in an array so preset locations are as follows
            //Array ( [0] => id [1] => name [2] => types [3] => height [4] => weight [5] => abilities [6] => egg_groups [7] => stats [8] => genus [9] => description )
            print_r(fgetcsv($file));
            //print('\n');
        }
        //print_r(fgetcsv($file));
        //return fgetcsv($file);
    }
}
