<?php

namespace App;

use App\Ability;
use App\EggType;
use App\Pokemon;
use App\Stat;
use App\Type;
//use Illuminate\Database\Eloquent\Model;

/*
Class to abstract the database representation of Pokemon. Allows the controllers to not worry about how it's actually stored.
*/

class PokemonRepository
{
    public function getPokemon($id)
    {
        $result = array(); //associative array ready to be sent as JSON
        $pokemon = Pokemon::find($id);

        $result['id'] = $pokemon->id;
        $result['name'] = $pokemon->name;
        $result['types'] = array();
        $result['height'] = $pokemon->height;
        $result['weight'] = $pokemon->weight;
        $result['abilities'] = array();
        $result['egg_groups'] = array();
        $result['stats'] = array();
        $result['genus'] = $pokemon->genus;
        $result['description'] = $pokemon->description;

        $stats = Stat::find($id);
        $types = Type::where('pokemon_id', $id)->get();
        $abilities = Ability::where('pokemon_id', $id)->get();
        $egg_types = EggType::where('pokemon_id', $id)->get();
        //var_dump($stats);

        foreach($abilities as $ability)
        {
            array_push($result['abilities'], $ability->ability);
        }

        foreach($egg_types as $egg_type)
        {
            array_push($result['egg_groups'], $egg_type->egg_type);
        }

        foreach($types as $type)
        {
            array_push($result['types'], $type->type);
            //print($type->type);
        }

        $result['stats']['hp'] = $stats->hp;
        $result['stats']['speed'] = $stats->speed;
        $result['stats']['attack'] = $stats->attack;
        $result['stats']['defense'] = $stats->defense;
        $result['stats']['special_attack'] = $stats->special_attack;
        $result['stats']['special_defense'] = $stats->special_defense;

        //var_dump($result);

        return $result;
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

        $stat = new Stat;
        $stat->hp = $stats->hp; //$stats is an object
        $stat->speed = $stats->speed;
        $stat->attack = $stats->attack;
        $stat->defense = $stats->defense;
        $stat->special_attack = $stats->{'special-attack'}; //since JSON allows a - but PHP does not, place the offending name in {} and it works fine
        $stat->special_defense = $stats->{'special-defense'};
        $stat->save(); //don't forget () ;)
        //var_dump($stat);

        foreach($abilties as $value) //abilities is an array
        {
            $ability = new Ability;
            $ability->pokemon_id = $id;
            $ability->ability = $value;
            $ability->save();
        }

        foreach($egg_groups as $value) //egg_groups is an array
        {
            $egg_type = new EggType;
            $egg_type->pokemon_id = $id;
            $egg_type->egg_type = $value;
            $egg_type->save();
        }

        foreach($types as $value) //types is an array
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
            $stats = json_decode($data[7]);
            $genus = $data[8];
            $description = $data[9];
            //print($id . ' ' . $name . ',');
            //var_dump($stats);
            
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
