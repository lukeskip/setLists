<?php
use App\Setlist as Setlist;
use App\Song as Song;
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
Route::post('/songs/{id}', 'SongController@attach');
Route::post('/newSong', 'SongController@store');
Route::post('/editSong/{id}', 'SongController@update');

Route::get('/pdf/{id}', 'SetlistController@print_pdf');

// Social plugins
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
	
Route::get('/print/{id}', function ($id) {
	$setlist = Setlist::findOrFail($id);
	$songs_list = $setlist->songs;
	$duration = 0;
	foreach ($songs_list as $key => $song) {
		$duration_str = explode(':',$song->duration);
		$minutes = $duration_str[0] * 60;
		$seconds = $duration_str[1];
			$adding  = $minutes + $seconds;
			$duration= $duration + $adding;
	}
	
	$duration = gmdate("i:s", $duration);
    $pdf = PDF::loadView('pdf.print',['setlist' => $setlist,'duration'=>$duration]);

  	return $pdf->download('Setlist'.$setlist->name.'.pdf');
});




