<?php

namespace App\Http\Controllers;

use App\Song as Song;
use App\Setlist as Setlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Validator;

class SongController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$songs = Song::where('user_id', $user_id)->orderBy('name')->get();
			return view('songs.index')->with('songs', $songs);
		}else{
			return redirect('/portada');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:songs|max:255'
		]);

		if ($validator->fails()) {
			return response()->json(['status' => 'error']); 
		}

		$type = 'songs_create';
		$id   = $request->input('id');
		$user_id = Auth::user()->id;
		$song = new Song(['user_id'=>$user_id,'name' => $request->input('name'),'intencity'=>$request->input('intencity'),'duration'=>$request->input('duration')]);
		

		if($request->input('simple')!='n'){
			$song->save();
		}else{
			$setlist = Setlist::findOrFail($id);
			$setlist->songs()->save($song, ['position' => $request->input('position')]);
		}
		 

		return response()->json(['status' => 'success','id'=>$id]);    
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id,Request $request)
	{
		
		
		

		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		
		$song = Song::find($id);
		$song->name  	 = $request->input('name');
		$song->intencity = $request->input('intencity');
		$song->duration  = $request->input('duration');
		$song->save();
		return response()->json(['status' => 'success']);	

	}

	public function attach(Request $request, $id)
	{
		
		$repeated 	 = false;
		$position    = $request->input('position');
		$setlist_id  = $request->input('setlist_id');
		$setlist 	 = Setlist::findOrFail($setlist_id);
		$array 		 = array();
 
		foreach ($setlist->songs as $key => $song) {
			if($song->id == $id){
				return response()->json(['status' => 'repeated','id'=>$setlist_id]);
			}
		}
		
		
		$setlist->songs()->attach($id, ['position' => $position]);
		return response()->json(['status' => 'success','id'=>$setlist_id]); 
	

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$findRecord = Song::findOrFail($id);
		$findRecord->delete();
		return response()->json(['status' => 'success','id'=>$id]);
	}
}
