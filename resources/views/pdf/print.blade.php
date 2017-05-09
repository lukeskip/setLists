@extends('layouts.pdf')
@section('menu_extra')
  <li><a href="#" class="send" data-email="{{{ Auth::user()->email}}}" data-id="{{$setlist->id}}" data-toggle="offCanvasLeft"><i class="fa fa-share-alt" aria-hidden="true" data-toggle="offCanvasLeft"></i> Compartir Setlist</a></li>
  <li><a href="#" class="create_song" data-toggle="offCanvasLeft"><i class="fa fa-plus-circle" aria-hidden="true"></i> Crear Canción</a></li>
@stop
@section('title')
  <span>{{{$setlist->name}}}</span> <span class="duration"> [Duración: {{$duration}}] </span>
@stop
@section('content')
  <div class="legal row" style="text-align: center;margin-bottom:50px;">
    Gracias, por utilizar el generador de Setlists de Rey Decibel.
  </div>
  <div class="row">
    <div class="large-12 columns">
      <ul id="sortable" class="list_rey">
        @foreach ($setlist->songs as $key => $song) 
              
              
          <li class="song " >   
              <span class="index">{{$key+1}}</span>
              <span class="intencity {{{$song->intencity}}}"></span>
              <span class="duration">[{{{$song->duration}}}]</span>
              <span class="title">{{{$song->name}}}</span>
          </li>
        @endforeach
      </ul>

    </div>
  </div>
  
  
@stop


