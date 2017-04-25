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
			
			$setlist = Setlist::findOrFail($id);
			
			if (Auth::user()->id === $setlist->user_id) {
            	return view('setlists.show', ['setlist' => Setlist::findOrFail($id),'songs'=>Song::where('setlist_id', '=',$id)->orderBy('position')->get()]);
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
		//REVISAMOS SI HAY INFORMACIÓN EN EL TÍTULO, LA VALIDAMOS Y GUARDAMOS
		if($request->input('name')!=''){
			$type = 'title';
			$validator = Validator::make($request->all(), [
				'name' => 'required|unique:setlists|max:255'
			]);

			if ($validator->fails()) {
				return response()->json(['status' => 'error']); 
			}

			$setlist = Setlist::findOrFail($id);;
			$name = $request->input('name');
			$setlist->name = $name;
			$setlist->update();
		}
		
		// CREAMOS LAS CANCIONES NUEVAS
		if($request->input('songs')!=''){
			$type = 'songs_create';
			$data = array();
			$setlist = Setlist::find($id);
			$songs = json_decode($request->input('songs'),true);

			foreach ($songs as $key => $value) {
				$row = array();
				$row['name'] = $value['title'];
				$row['position'] = $value['position'];
				$data[] = $row;

			}
			$setlist->songs()->createMany($data);    
		}

		// ACTUALIZAMOS CANCIONES CREADAS
		if($request->input('songs_update')!=''){
			$type = 'songs_update';
			$songs_update = json_decode($request->input('songs_update'),true);

			foreach ($songs_update as $key => $value) {

				$song = Song::findOrFail($value['id']);
				$name = $value['title'];
				$song->name = $name;
				$position = $value['position'];
				$song->position = $position;

				$song->update();
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
	public function destroy($id)
	{
		$findRecord = Setlist::findOrFail($id);
		$findRecord->delete();
		return 'success';
	}
}
