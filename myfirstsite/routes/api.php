<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//admin
Route::get('admin/setup', 'PokemonController@setup');

//pokemon
Route::get('pokemon', 'PokemonController@paginate'); //paginated. Takes two get parameters. page=page number and per_page= number of pokemon per page(this one is optional 15 is default)
Route::get('pokemon/{id}', 'PokemonController@show'); //single

//trainer
Route::get('register', 'Auth\RegisterController@register'); //make new trainer
Route::get('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');

//authentication required. Need the get/post request to contain api_token=yourtoken  This is gotten from login
Route::get('trainer/', 'TrainerController@show'); //view caught pokemon
Route::get('trainer/mark', 'TrainerController@mark'); //mark a pokemon as caught. uses pokemon_id=number from get request to set the pokemon

//test
Route::get('csv', 'PokemonController@csvTest');
Route::get('test', 'PokemonController@test');

//Route::get();
