<?php

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
Route::get('/','SetlistController@index');
Route::get('logout', function (){
	Auth::logout();
	return redirect('/');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('setlists', 'SetlistController');
Route::post('deleteSetlist/{id}','SetlistController@destroy');
Route::post('deleteSong/{id}','SongController@destroy');
Route::post('/send', 'EmailController@send');
Route::post('/addSetlist', 'Setlist@store');





