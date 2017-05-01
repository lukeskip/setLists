@extends('layouts.presskit')

@section('content')
<div class="steps">
	<div class="step step_1 active">1</div>
	<div class="step step_2">2</div>
	<div class="step step_3">3</div>
	<div class="step step_4">4</div>
	<div class="step step_5">5</div>
</div>
<div class="counter">
	<div id="characters"></div>
</div>
<div class="owl-carousel">
  
  <!-- START:STEP -->
  <div data-id="generales">
	<div class="row">
		<div class="large-6 large-centered columns">
			<h2>Datos generales...</h2>
			<div class="text_wrapper">
				<textarea name="" id="" cols="30" rows="10"></textarea>
				<div class="counter" data-limit="300"></div>
			</div>
			<div class="text-right">
				<a href="#" class="rey_button small next">Siguiente</a>	
			</div>
			
			
		</div>  
	</div> 
  </div>
  <!-- END:STEP -->

  <!-- START:STEP -->
  <div data-id="generales">
	<div class="row">
		<div class="large-12 columns">
			<h2>Historia...</h2>
		</div>  
	</div> 
  </div>
  <!-- END:STEP -->

  <!-- START:STEP -->
  <div>
	<div class="row">
		<div class="large-12 columns">
			<h2>Sonido...</h2>
		</div>  
	</div> 
  </div>
  <!-- END:STEP -->


  <!-- START:STEP -->
  <div>
	<div class="row">
		<div class="large-12 columns">
			<h2>Miembros...</h2>
		</div>  
	</div> 
  </div>
  <!-- END:STEP -->


  <!-- START:STEP -->
  <div>
	<div class="row">
		<div class="large-12 columns">
			<h2>Datos de contacto...</h2>
		</div>  
	</div> 
  </div>
  <!-- END:STEP -->

  <!-- START:STEP -->
  <div>
	<div class="row">
		<div class="large-12 columns">
			<h2>Sobre tu banda...</h2>
		</div>  
	</div> 
  </div>
  <!-- END:STEP -->
  
</div>

@endsection