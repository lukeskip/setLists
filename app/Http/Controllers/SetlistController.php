<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Setlist as Setlist;
use App\Song as Song;
use Illuminate\Support\Facades\Auth as Auth;
use Validator;

class SetlistController extends Controller
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
			$setlists = Setlist::where('user_id', $user_id)->get();
			return view('setlists.index')->with('setlists', $setlists);
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
			'name' => 'required|unique:setlists|max:255'
		]);

		if ($validator->fails()) {
			return response()->json(['status' => 'error']); 
		}

		$setlist = new Setlist();
		$name = $request->input('name');
		$setlist->user_id = Auth::user()->id;
		$setlist->name = $name;
		$setlist->save();

	
		return response()->json(['status' => 'success','id'=>$setlist->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if (Auth::check()) {
			$user_id = Auth::user()->id;
			$setlist = Setlist::findOrFail($id);
			$songs = Song::where('user_id', $user_id)->get();

			if ($user_id === $setlist->user_id) {
            	return view('setlists.show', ['setlist' => $setlist,'songs'=>$songs]);
        	}else{
        		return "No estas autorizado para estar aquí";
        	}
			
		}else{
			return redirect('/login');
		}
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
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
		$type = 'none';
		$data = array();
		$setlist = Setlist::findOrFail($id);
		//REVISAMOS SI HAY INFORMACIÓN EN EL TÍTULO, LA VALIDAMOS Y GUARDAMOS
		if($request->input('name')!=''){
			$type = 'title';
			$validator = Validator::make($request->all(), [
				'name' => 'required|unique:setlists|max:255'
			]);

			if ($validator->fails()) {
				return response()->json(['status' => 'error']); 
			}

			
			$name = $request->input('name');
			$setlist->name = $name;
			$setlist->update();
		}
		
		// CREAMOS LAS CANCIONES NUEVAS
		if($request->input('songs')!=''){

			    
		}

		// ACTUALIZAMOS POSICIONES DE CANCIONES
		if($request->input('songs_update')!=''){
			$type = 'songs_update';
			$songs_update = json_decode($request->input('songs_update'),true);
			foreach ($songs_update as $key => $value) {
				Setlist::find($id)->songs()->updateExistingPivot($value['id'], [ 'position' => $value['position']]);

			}
			
			
		}

		return response()->json(['status' => 'success','id'=>$setlist->id,'type'=>$type]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id,Request $request)
	{

		if($request->input('type')== 'song_detach'){
			$type  	 = 'song_detach';
			$song_id =  $request->input('song_id');
			$setlist = Setlist::findOrFail(1);
			$setlist->songs()->detach($song_id);

		}else if($request->input('type')== 'setlist_delete'){
			$type = 'setlist_delete';
			$setlist = Setlist::findOrFail($id);
			$setlist->delete();
			
		}

		return response()->json(['status' => 'success','type'=>$type,'id',$id]);
	}
}
