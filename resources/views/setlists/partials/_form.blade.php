{!! Form::label('name','Título:') !!}
{!! Form::text('name') !!}
{!! $errors->first('name','<div class="alert callout">:message</div>') !!}
{{-- {!! Form::submit('Guardar',['class' => 'rey_button green']) !!} --}}
<a href="#" class="rey_button green submit">
	<i class="fa fa-check-circle-o" aria-hidden="true"></i> Guardar
</a>