<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Generador de SetList</title>
		

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="shortcut icon" type="favicon/png" href="{{asset('img/favicon.png')}}"/>
		
		
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
		<style>
			@import url('https://fonts.googleapis.com/css?family=Kanit:400,900|Raleway');

/*songs*/

html,body{
	font-family: 'Raleway', sans-serif;
	height: 100%;

}

body{
	background-color: white;
	background-position: center;
	font-family: 'Raleway', sans-serif; 
	color:#333;
}


/*FORM*/

input[type="text"]{
	border-radius:5px;
}

h2{
	font-size: 1.5em;
}
@media only screen and (max-width: 500px) {
	h2{
	font-size: 1em;
}
}

.container{
	margin-top: 20px;
	width: 80%;
	max-width: 600px;
	margin:auto;
	padding-top: 50px;
	padding-bottom: 20px;

}

h1,h2,h3{
	font-family: 'Raleway', sans-serif;
	font-weight: 900;
	text-align: center;
}

h2{
	text-transform: uppercase;
}
nav.main{
	margin-bottom: 30px;	
}
nav.main ul{
	text-align: center;
}
nav.main ul li{
	list-style: none;
	display: inline-block;
	margin-right:10px;
	border-left:1px solid white;
	padding-left: 10px;
}
nav.main ul li:first-child{
	border-left:none;
}
nav.main ul li a{
	color:white;
}

/*SONGS */


.list_rey{
	margin:auto;
}

.list_rey li{
	list-style: none;
	color:#DE353A;
	padding: 10px;
	margin-bottom:10px;
	border-radius: 5px;
	position: relative;
	overflow: hidden;
	padding-left: 20px;
	font-size: 2em;

}


.list_rey li a{
	color:#DE353A;
	width:100%;
	height: 100%;
	display: block;
	font-size: 2em;
}




.list_rey li.song{
	cursor: all-scroll;
	font-size: 2em;
}

.list_rey li.song.list_song{
	cursor: default;
}

.list_rey li.song .intencity{
	width: 5px;
	height: 100px;
	background-color: #333;
	display: inline-block;
	position: absolute;
	top: 0;
	left: 0;
	text-indent: -9999px;
	overflow: hidden;
}

.list_rey li.song .intencity.high{
	background-color: red;
}

.list_rey li.song .intencity.medium{
	background-color: #F1BD2B;
}

.list_rey li.song .intencity.low{
	background-color: #00BF22;
}



/*SETLIST & SONGS*/
.title{
	color: black;
}

.duration{
	color:#333;
}

h1 .duration{
	font-size: .8em;
}
.index{
	color:black;
}


		</style>

	</head>
	<body>
		<div class="legal row" style="text-align: center;margin-bottom:50px;">
			<img src="{{asset('img/logo_rey.png')}}" width="150" alt=""><br>
    		Gracias, por utilizar el generador de Setlists de Rey Decibel.
  		</div>
		<h1>
			@yield('title')
		</h1>
		
		@yield('content')


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

