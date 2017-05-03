@extends('layouts.main')
@section('title')
	Tus Setlists
@stop
@section('content')
	<a class="rey_button green" data-open="form_create"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo Setlist</a>

	<ul class="list_rey">
	@foreach ($setlists as $list)
		<li>
			{!! link_to_route('setlists.show', $list->name, [$list->id]) !!}
			<div class="trash" data-id="{{{$list->id}}}" data-type="setlist_delete"><i class="fa fa-trash" aria-hidden="true"></i></div>
		</li>
		
	@endforeach
	</ul>
	


@stop

@section('modal')
	<div class="reveal" id="form_create" data-reveal>
	  <h2>Agrega un setlist</h2>
	  
		{!! Form::open(array('route' => 'setlists.store','id'=>'add_setlist','data-type'=>'setlist')) !!}
			@include('setlists.partials._form')
		{!! Form::close() !!}
		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
		</button>

	</div>
@stop