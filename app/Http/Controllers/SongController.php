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
			$songs = Song::where('user_id', $user_id)->get();
			return view('songs.index')->with('songs', $songs);
		}else{
			return redirect('/login');
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
		$setlist = Setlist::findOrFail($id);
		$song = new Song(['user_id'=>$user_id,'name' => $request->input('name'),'intencity'=>$request->input('intencity'),'duration'=>$request->input('duration')]);

		$setlist->songs()->save($song, ['position' => $request->input('position')]); 

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
		$repeated = false;
		$position   	= $request->input('position');
		$setlist_id 	= $request->input('setlist_id');
		$setlist = Setlist::findOrFail($setlist_id)->with('songs')->first();
		

		foreach ($setlist->songs as $key => $song) {
			if($song->id == $id){
				$repeated = true;
			}
		}
		
		
		if(!$repeated){
			$setlist->songs()->attach($id, ['position' => $position]);
			return response()->json(['status' => 'success','id'=>$setlist_id]); 
		}else{
			return response()->json(['status' => 'repeated','id'=>$setlist_id]);
		}
		
		

		
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
		return 'success';
	}
}
