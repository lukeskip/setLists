@extends('layouts.main')
@section('content')
	
	<h2 class="text-center">{{{$setlist->name}}}</h2>

	<ul id="sortable" class="list_rey">

	@foreach ($setlist->songs as $song) 
				
				
   		<li>{{{$song->name}}}</li>
   	@endforeach
   	</ul>
@stop