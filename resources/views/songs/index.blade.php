@extends('layouts.main')
@section('title')
	Tus Canciones
@stop
@section('content')
	<a class="rey_button green create_song_song"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva Canción</a>

	<ul class="list_rey">
	@foreach ($songs as $song)
		<li class='song list_song'>
		 	<a href="#" data-id="{{{$song->id}}}">
				<span class="intencity {{{$song->intencity}}}">{{{$song->intencity}}}</span>
				<span class="duration" data-value="{{$song->duration}}">[{{$song->duration}}]</span> 
				<span class='title'>{{$song->name}}</span>  
				<div class="trash_song" data-id="{{{$song->id}}}"><i class="fa fa-trash" aria-hidden="true"></i></div>
				<div class="edit edit_song" data-id="{{{$song->id}}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</div>
			</a>
		</li>
		
	@endforeach
	</ul>
	


@stop

@section('modal')
	<div class="reveal" id="form_create" data-reveal>
	  <h2 >Agrega una nueva canción</h2>
		
			<form id="song_save" action="">
				<div class="row">
					<div class="large-12 columns">
						<label>Título:</label>
						<input type="text" class="song_input" name="name">
						<input type="hidden"  name="_method" value="POST">
						<input type="hidden"  name="simple" value="y" class="simple">
						<input type="hidden"  name="action" value="" class="action">
						<input type="hidden"  name="songs" value="true">
						<input type="hidden"  value="" class="song_edit_id">	
					</div>
					
				</div>
				<div class="row">
					<div class="medium-4 column">
						<label>Intencidad:</label>
						<fieldset>
							<div class="option high">
								<label for="high">Alta</label>
								<input type="radio"  name="intencity" value="high" id="high">
							</div>
							<div class="option medium">
								<label for="medium">Media</label>
								<input type="radio"  name="intencity" value="medium" id="medium">
							</div>
							<div class="option low">
								<label for="low">Baja</label>
								<input type="radio"  name="intencity" value="low" id="low">
							</div>
							
						</fieldset>
					</div>
					<div class="medium-8 column">
						<br>
						<label>Duración:<br><br></label>
						<div class="wrapper_slider">
							<div class="duration_slider"></div>
							<div class="display_slider">00:00</div>
						</div>
						<input type="hidden" name="duration" class="song_duration">	
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<br>
						<div class="rey_button green song_save">Guardar</div>
					</div>
				</div>
				
				
				<button class="close-button" data-close aria-label="Close modal" type="button">
					<span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
				</button>
			</form>
	</div><!--END CREATE-->


	
@stop