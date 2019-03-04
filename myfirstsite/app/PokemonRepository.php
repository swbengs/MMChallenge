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
    public function paginate($args) //args is the request given to us. page is required, per_page is not
    {
        //null coalescing operator neat
        $page = $args['page'] ?? 0;
        if($page === 0)
        {
            return 404; //return error, can be something other than 404 not found. 203 is bad request? check on this
        }
        //var_dump($args);
        $per_page = $args['per_page'] ?? 15; //combo of isset and ternary operator

        $paginate = Pokemon::simplePaginate($per_page);
        return($paginate->toJson());

        //return(array('page' => $page, 'per_page' => $per_page));
        //print($page . ', ' . $per_page);
    }

    //method to get all of a pokemon's information
    public function getPokemon($id)
    {
        $result = $this->getPokemonOnly($id); //associative array ready to be sent as JSON
        $result['types'] = $this->getPokemonTypes($id);
        $result['abilities'] = $this->getPokemonAbilities($id);
        $result['egg_groups'] = $this->getPokemonEggGroups($id);
        $result['stats'] = $this->getPokemonStats($id);
        
        //var_dump($result);

        return $result;
    }

    //method to get just the pokemon table information and return as array
    public function getPokemonOnly($id)
    {
        $result = array();

        $pokemon = Pokemon::find($id);
        $result['id'] = $pokemon->id;
        $result['name'] = $pokemon->name;
        $result['height'] = $pokemon->height;
        $result['weight'] = $pokemon->weight;
        $result['genus'] = $pokemon->genus;
        $result['description'] = $pokemon->description;

        return $result;
    }

    //method to get a pokemon's abilities and return as an array
    public function getPokemonAbilities($id)
    {
        $result = array();
        $abilities = Ability::where('pokemon_id', $id)->get();

        foreach($abilities as $ability)
        {
            array_push($result, $ability->ability);
        }

        return $result;
    }

    //method to get a pokemon's egg groups and return as an array
    public function getPokemonEggGroups($id)
    {
        $result = array();

        $egg_types = EggType::where('pokemon_id', $id)->get();

        foreach($egg_types as $egg_type)
        {
            array_push($result, $egg_type->egg_type);
        }

        return $result;
    }

    //method to get a pokemon's stats and return as an array
    public function getPokemonStats($id)
    {
        $result = array();

        $stats = Stat::find($id);

        $result['hp'] = $stats->hp;
        $result['speed'] = $stats->speed;
        $result['attack'] = $stats->attack;
        $result['defense'] = $stats->defense;
        $result['special_attack'] = $stats->special_attack;
        $result['special_defense'] = $stats->special_defense;

        return $result;
    }

    //method to get a pokemon's types and return as an array
    public function getPokemonTypes($id)
    {
        $result = array();
        $types = Type::where('pokemon_id', $id)->get();
        foreach($types as $type)
        {
            array_push($result, $type->type);
            //print($type->type);
        }

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

        fclose($file);

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
