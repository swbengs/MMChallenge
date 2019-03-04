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

//test
Route::get('csv', 'PokemonController@csvTest');
Route::get('test', 'PokemonController@test');

//Route::get();
