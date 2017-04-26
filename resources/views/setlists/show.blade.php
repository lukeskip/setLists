@extends('layouts.main')
@section('title')
	<span class="edit">{{{$setlist->name}}}</span>
@stop
@section('content')
	
	<div class="row">
		
		<div class="medium-6 columns">
			<a class="rey_button save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</a>
		</div>
	
		<div class="medium-6 columns">
			<a class="rey_button  send" data-email="{{{ Auth::user()->email}}}" data-id="{{$setlist->id}}"><i class="fa fa-share-alt" aria-hidden="true"></i> Compartir</a>
		</div>

		<div class="large-12 columns">
			<a class="rey_button green  add_song"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Canción</a>
		</div>

	</div>

	<div class="row">
		<div class="large-12 columns">
			<ul id="sortable" class="list_rey">

				@foreach ($songs as $key => $song) 
							
							
			   		<li class="song old" 
			   			data-title="{{{$song->name}}}" 
			   			data-position="{{{$song}}}" 
			   			data-id="{{{$song->id}}}"
			   			data-type="old"
			   		>
				   			<span class="title">{{{$song->name}}}</span>
				   			<div class="trash" data-type="song" data-id="{{{$song->id}}}"><i class="fa fa-trash" aria-hidden="true"></i></div>
			   		</li>
			   	@endforeach
			</ul>
	   	</div>
   	</div>
   	<div class="row">
   		<div class="large-12 columns text-center">
   			<small>
				Instrucciones: Agrega una canción nueva, dando click sobre ella podrás cambiar su nombre, finalmente, arrástralas para ordenarlas a tus gusto.
			</small>
   		</div>
   	</div>
@stop
@section('modal')
	<div class="reveal" id="form_create" data-reveal>
	  <h2 >Edita el nombre de la canción</h2>
	  	<form id="song_save" action="">
			<input type="text" class="song_input">
			<div class="rey_button green song_save">Guardar</div>
			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
			</button>
		</form>

	</div>

	<div class="reveal" id="form_update" data-reveal>
	  <h2>Editando {{{$setlist->name}}}</h2>
		{!! Form::open(array('route' => ['setlists.update', $setlist->id],'method'=>'PUT','id'=>'update_setlist','data-type'=>'title')) !!}
			<input type="hidden" name="id" value="{{{$setlist->id}}}">
			@include('setlists.partials._form')
		{!! Form::close() !!}
		<button class="close-button" data-close aria-label="Close modal" type="button">
			<span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
		</button>

	</div>

	<div class="reveal" id="form_send" data-reveal>
	  <h2 >Comparte este setlist</h2>

	  	<form id="setlist_send" action="">
	  		<label for="">Escribe uno o varios correos electrónicos separados con una coma</label>
	  		
	  		<input type="hidden" class="setlist_send_id" value="{{{$setlist->id}}}">
			<input type="text" class="setlist_send_input" value="{{{ Auth::user()->email}}}">
			<div class="rey_button green setlist_send">Guardar</div>
			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
			</button>
		</form>
	</div>
@stop