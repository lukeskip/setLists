@extends('layouts.main')
@section('menu_extra')
	<li><a href="#" class="send" data-email="{{{ Auth::user()->email}}}" data-id="{{$setlist->id}}" data-toggle="offCanvasLeft"><i class="fa fa-share-alt" aria-hidden="true" data-toggle="offCanvasLeft"></i> Compartir Setlist</a></li>
	<li><a href="#" class="create_song" data-toggle="offCanvasLeft"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear Canción</a></li>
@stop
@section('title')
	<span class="edit">{{{$setlist->name}}}</span> <span class="duration"> [{{$duration}}] </span>
@stop
@section('content')
	<div class="waves">
		<h2>Línea de Intensidad</h2>
		<div class="wave_graphic">
			<canvas id="myChart" width="80%" height="80"></canvas>
		</div>
	</div>
	<div class="row">
		
		<div class="medium-6 columns">
			<a class="rey_button save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</a>
		</div>

		<div class="medium-6 columns">
			<a class="rey_button green  add_song"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Canción</a>
		</div>

	</div>

	<div class="row">
		<div class="large-12 columns">
			<ul id="sortable" class="list_rey">
				@foreach ($setlist->songs as $key => $song) 
							
							
					<li class="song old" 
						data-title="{{{$song->name}}}" 
						data-position="{{{$song->pivot}}}" 
						data-id="{{{$song->id}}}"
						data-intencity="{{{$song->intencity}}}"
						data-duration="{{{$song->duration}}}"
						data-type="old"
					>		
							<span class="intencity {{{$song->intencity}}}"></span>
							<span class="duration">[{{{$song->duration}}}]</span>
							<span class="title">{{{$song->name}}}</span>
							<div class="trash" data-type="song_detach" data-song_id="{{{$song->id}}}" data-id="{{{$setlist->id}}}"><i class="fa fa-trash" aria-hidden="true"></i></div>
					</li>
				@endforeach
			</ul>

		</div>
	</div>
	
@stop
@section('modal')
	<div class="reveal" id="form_create" data-reveal>
	  <h2 >Agrega una nueva canción</h2>
		
			<form id="song_save" action="">
				<div class="row">
					<div class="large-12 columns">
						<label>Título:</label>
						<input type="text" class="song_input" name="name">
						<input type="hidden"  name="id" value="{{$setlist->id}}">
						<input type="hidden"  name="_method" value="POST">
						<input type="hidden"  name="songs" value="true">
						<input type="hidden"  name="simple" value="n" class="simple">	
					
					</div>
					
				</div>
				<div class="row">
					<div class="medium-4 column">
						<label>Intencidad:</label>
						<fieldset>
							<div class="option high">
								<label for="high">Alta</label>
								<input type="radio" name="intencity" value="high" id="high">
							</div>
							<div class="option medium">
								<label for="medium">Media</label>
								<input type="radio" name="intencity" value="medium" id="medium">
							</div>
							<div class="option low">
								<label for="low">Baja</label>
								<input type="radio" name="intencity" value="low" id="low">
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
			<div class="rey_button green setlist_send">Enviar</div>
			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
			</button>
		</form>
	</div>

	<div class="reveal" id="form_add" data-reveal>
	  <h2 >Selecciona de entre tus canciones</h2>

		<form id="song_add" action="">
			<input type="hidden" name="setlist_id" value="{{{$setlist->id}}}">
			<select name="song_to_add" id="" class="song_to_add">
				<option value="">Busca la canción escribiendo</option>
				@foreach ($songs as $key => $song)
					<option value="{{$song->id}}">{{$song->name}}</option>
				@endforeach
			</select>
			<div class="rey_button green song_add_button">Enviar</div>
			<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
			</button>
		</form>
	</div>
@stop

@section('javascript')
	<script>
		$(document).ready(function(){
			high    = 15;
			medium  = 5;
			low		= 1;

			var chartColors = {
			  red: 'rgb(255, 99, 132)',
			  orange: 'rgb(255, 159, 64)',
			  yellow: 'rgb(255, 205, 86)',
			  green: 'rgb(75, 192, 192)',
			  blue: 'rgb(54, 162, 235)',
			  purple: 'rgb(153, 102, 255)',
			  grey: 'rgb(231,233,237)',
			  white: 'rgba(256,256,256)'
			};
			Chart.defaults.global.legend.display = false;
			// Chart.scaleLabel.display = false;

			
			var ctx = $('#myChart');
			var myLineChart = Chart.Line(ctx, {
				scaleShowBackgroudColor: false,
				
				scaleShowLabels : false,
				data: {
					datasets: [{
						label: '',
						steppedLine	:false,
						fill: false,
						borderColor:'rgba(256,256,256,.5)',
						data: [
							
							@foreach ($setlist->songs as $key => $song) 
							{
								x: {{$key+1}},
								y: {{$song->intencity}}
							},
							@endforeach
							 
						]
					}]
				},
				options: {
					
					responsive: true,
					scales: {
						
						xAxes: [{
						
							type: 'linear',
                			position: 'bottom',
                			
						}],
						yAxes: [{
						

							
						}]
					},
					maintainAspectRatio: false,
				}
			});


		});
	</script>
@stop