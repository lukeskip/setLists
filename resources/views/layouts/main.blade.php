<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Generador de SetList</title>
		<link rel="stylesheet" href="{{asset('css/foundation.css')}}">

		<link rel="shortcut icon" type="favicon/png" href="{{asset('img/favicon.png')}}"/>
		
		<link rel="stylesheet" href="{{asset('js/vendor/jquery-ui/jquery-ui.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/app.css')}}">

		{{-- <meta property="og:title" content="Qué tipo de músico eres" />
		<meta property="og:url" content="http://tipodemusico.reydecibel.com.mx/" />
		<meta property="og:image" content="http://tipodemusico.reydecibel.com.mx/img/facebook_share.png" /> --}}
	</head>
	<body>
		
		<div class="container">

		
				
				<!-- <section data-background-image="img/back.jpg">
				
					<a class="" target="_top" href="https://www.facebook.com/v2.8/dialog/oauth?
  client_id=851875531619550&scope=public_profile,email
  &redirect_uri=http://tipodemusico.reydecibel.com.mx/">
  					<img src="img/portada.png" alt="">
  				</a>
  				<a class="next" target="_top" href="">
  					<img src="img/portada.png" alt="">
  				</a>
  				<form action="" id="register">
  					<input type="hidden" name="name" class="name">
  					<input type="hidden" name="lastname" class="lastname">
  					<input type="hidden" name="mail" class="mail">
  					<input type="hidden" name="score" class="score">
  					<input type="hidden" name="answers" class="answers">
  				</form>

				</section> -->
				@yield('content')
				
				
				
		</div>
		

		<script src="{{asset('js/vendor/jquery.js')}}"></script>
		<script src="{{asset('js/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
		<script src="{{asset('js/vendor/jquery-ui/touchpunch.js')}}"></script>
		<script src="{{asset('js/vendor/what-input.js')}}"></script>
		<script src="{{asset('js/vendor/foundation.js')}}"></script>
		<script src="{{asset('plugins/angular/angular.min.js')}}"></script>

		<script src="{{asset('js/app.js')}}"></script>
	</body>
</html>

