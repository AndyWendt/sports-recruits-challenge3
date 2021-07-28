<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TeamController@index')->name('index');


//POST http://sports-recruits-challenge3.lcl/ranking/2?value=2
Route::post('ranking/{user}', function (\App\User $user, \Illuminate\Http\Request $request) {
	$user->ranking = $request->input('value');
	$user->save();

	response(200);
});