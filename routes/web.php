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
Route::get('logout', function (){
	Auth::logout();
	return redirect('/');
});
Auth::routes();

Route::get('bienvenido', function (){
	return view('setlists.welcome');
});

Route::get('/', function (){
	return view('setlists.portada');
});



Route::get('/home', 'SetlistController@index');
Route::resource('setlists', 'SetlistController');
Route::resource('presskits', 'PresskitController');
Route::post('deleteSetlist/{id}','SetlistController@destroy');
Route::post('deleteSong/{id}','SongController@destroy');
Route::get('/songs','SongController@index')->name('songsIndex');;
Route::post('/send', 'EmailController@send');
Route::post('/songs/{id}', 'SongController@edit');
Route::post('/newSong', 'SongController@store');





