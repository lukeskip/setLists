<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Generador de SetList</title>
		<link rel="stylesheet" href="{{asset('js/vendor/selectize/css/selectize.default.css')}}">
		<link rel="stylesheet" href="{{asset('css/foundation.css')}}">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="shortcut icon" type="favicon/png" href="{{asset('img/favicon.png')}}"/>
		
		<link rel="stylesheet" href="{{asset('js/vendor/jquery-ui/jquery-ui.min.css')}}">
		<link rel="stylesheet" href="{{asset('js/vendor/sweetalert/sweetalert.css')}}">
		

		<link rel="stylesheet" href="{{asset('css/app.css')}}">
		
		<meta property="og:url"                content="http://setlist.reydecibel.com.mx" />
		<meta property="og:title"              content="Generador de Setlist" />
		<meta property="og:description"        content="Esta es una gran herramienta, indispensable para bandas independientes" />
		<meta property="og:image"              content="{{asset('img/facebook_share.png')}}" />

		<script type="text/javascript">
			var APP_URL = {!! json_encode(url('/')) !!}
		</script>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<meta name="description" content="Esta es una plataforma que te ayudará a generar los setlists para tu show o tocadas" />
		<meta name="keywords" content="setlist, bandas, show, tocada, bandas independientes" />
		<meta name="author" content="metatags generator">
		<meta name="robots" content="index, follow">
		<meta name="revisit-after" content="3 month">

		<title>Generador de Setlists</title>

	</head>
	<body>
	<div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>

	    <!-- Close button -->
	    <button class="close-button" aria-label="Close menu" type="button" data-close>
	      <span aria-hidden="true">&times;</span>
	    </button>

	    <!-- Menu -->
	    <div class="logo_menu ext-center"><img src="{{asset('img/logo_rey.png')}}" alt="" width="200px;"></div>
	    <ul class="vertical menu">
			<li>
				
				<a target="_blank" href="http://reydecibel.com.mx">
				<i class="fa fa-newspaper-o" aria-hidden="true"></i> Blog
				</a>
			</li>
			<li>
				<a href="/setlists">
					<i class="fa fa-list" aria-hidden="true"></i> Mis Setlists
				</a>
			</li>
			<li>
				<a href="/songs">
					<i class="fa fa-music" aria-hidden="true"></i> Mis Canciones
				</a>
			</li>
			</li>
			@yield('menu_extra')
			<li>
				<a target="_blank" href="https://www.facebook.com/ReyDecibelMx/">
				<i class="fa fa-facebook-official" aria-hidden="true"></i> Síguenos
			</a>
			<li>
				<a href="/logout">
					<i class="fa fa-sign-out" aria-hidden="true"></i> Salir
				</a>
			</li>
	    </ul>
	    <div class="legal">

			Todos los derechos reservados,2017. <a style="color:white" target="_blank" href="http://www.reydecibel.com.mx/terminos-condiciones-generador-setlists/">Términos y condiciones</a>
		</div>

	  </div>

  <div class="off-canvas-content" data-off-canvas-content>
 
		<div class="beta">Beta</div>
		<div class="loader_wrapper">
			<div class="loader"></div>
		</div>	
		<a class="menu_start" data-toggle="offCanvasLeft">
			<i class="fa fa-bars" aria-hidden="true"></i>
			MENÚ
		</a>
		<div class="container">
			
			<h1 class="text-center">
				@yield('title')
			</h1>
			

			
			@yield('content')	
				
					
				
		</div><!--END: CONTAINER-->
		{{-- <footer>
			
		</footer> --}}
</div><!-- END OFF CANVAS WRAPPER-->

		@yield('modal')
		
		
		<script src="{{asset('js/vendor/jquery.js')}}"></script>
		<script src="{{asset('js/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
		<script src="{{asset('js/vendor/jquery-ui/touchpunch.js')}}"></script>
		<script src="{{asset('js/laroute.js')}}"></script>
		<script src="{{asset('js/vendor/what-input.js')}}"></script>
		<script src="{{asset('js/vendor/foundation.js')}}"></script>
		<script src="{{asset('js/vendor/selectize/js/selectize.min.js')}}"></script>
		<script src="{{asset('js/vendor/sweetalert/sweetalert.min.js')}}"></script>
		<script src="{{asset('js/bower_components/chart.js/dist/Chart.min.js')}}"></script>


		<script src="{{asset('js/app.js')}}"></script>

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-73222704-1', 'auto');
		  ga('send', 'pageview');

		</script>

		@yield('javascript')
	</body>
</html>

