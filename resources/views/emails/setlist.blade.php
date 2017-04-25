<html>
<head></head>
<body style="background: #eeeeee; color: white">

<div style="width:600px;margin:auto;margin-top:40px;background:white;">
<table style="width:100%; border-radius: 5px;" border="0" cellspacing="0" cellpadding="0">
  <tr style="background: #AF0929; padding: 40px;">
    <th style="padding: 40px;"><img src="{{asset('img/logo_rey.png')}}" width="150" alt=""></th>
  </tr>
  <tr>
    <td>
    <br><br><br>
    <h1 style="color:#AF0929; text-align: center; font-size: 40px">Setlist {{$setlist->name}}</h1>
   
@foreach ($songs as $key => $song) 			
	 <div style="background: #EEEEEE; color:black; padding: 10px;text-align: center; border-radius: 5px;font-size: 25px; margin:20px;">
		<span>{{{$key}}}.-</span>
		<span class="title">{{{$song->name}}}</span>
		<div class="trash" data-type="song" data-id="{{{$song->id}}}"><i class="fa fa-trash" aria-hidden="true"></i></div>
	</div>
@endforeach
	<br><br><br>
	</td>
  </tr>
  <tr style="background: #AF0929; padding: 40px">
    <th style="padding: 40px">Rey Decibel, todos los derechos reservados, 2017</th>
  </tr>
</table>
</div>

</body>
</html>