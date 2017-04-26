@extends('layouts.main')
@section('title')
	<span class="edit">Bienvenido</span>
@stop
@section('content')
	
	
	<div class="text-center">
		<img src="{{asset('img/portada.png')}}" width="400" alt="">
	</div>
	<br><br>
	<a class="rey_button green" data-open="form_create"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crea tu primer setlist</a>
	
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
@section('javascript')
	<script>
		sweetAlert("Gracias por tu registro", "Recuerda que aún estamos en fase beta!", "success");
	</script>
@stop