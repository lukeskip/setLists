@extends('layouts.main')
@section('content')
	<h2 class="text-center">Tus Setlist</h2>
	<ul class="list_rey">
	@foreach ($setlists as $list)
		<li>{!! link_to_route('setlists.show', $list->name, [$list->id]) !!}</li>
		
	@endforeach
	</ul>
@stop