
$(document).foundation();
$(document).ready(function(){

	// window.fbAsyncInit = function() {
	// FB.init({
	//   appId      : '851875531619550',
	//   status	 : true,
	//   xfbml      : true,
	//   cookie	 : true,
	//   version    : 'v2.8'
	// });

	// };

	// (function(d, s, id){
	//  var js, fjs = d.getElementsByTagName(s)[0];
	//  if (d.getElementById(id)) {return;}
	//  js = d.createElement(s); js.id = id;
	//  js.src = "//connect.facebook.net/en_US/sdk.js";
	//  fjs.parentNode.insertBefore(js, fjs);
	// }(document, 'script', 'facebook-jssdk'));

	// setTimeout(function(){
	// 	FB.getLoginStatus(function(response) {
	// 	  if (response.status === 'connected') {
	// 	    FB.api('/me', {fields: 'email,first_name,last_name'}, function(response){
	// 				$("#register .name").val(response.first_name);
	// 				$("#register .lastname").val(response.last_name);
	// 				$("#register .mail").val(response.email);
					
	// 				name =  response.first_name;

	// 				console.log(response.email);
	// 				Reveal.next();
	// 		});

	// 	  } else if (response.status === 'not_authorized') {
		    
	// 	  } else {
	// 	    // the user isn't logged in to Facebook.
	// 	  }
	//  	});
	// },1000);



	$('body').on('click', '.song', function() {

		title = $(this).html();
		$(this).parent().data("title",title);
		$(this).parent().data("status","open");
		$(this).data("status","open");
		$(this).parent().html("<input class='input_text' type='text' value='"+title+"'><div class='button small save'>Aceptar</div>");
	});

	$('body').on('click', '.save', function() {
    	title = $(this).parent().find(".input_text").val();
    	if(title != ""){
    		parent = $(this).parent();
			parent.html("<a class='song'>"+title+"</a><a class='trash'>x</a>");
			parent.data("status","closed");
    	}else{
    		title = $(this).parent().data("title");
    		parent = $(this).parent();
			parent.html("<a class='song'>"+title+"</a><a class='trash'>x</a>");
			parent.data("status","closed");
    	}
		
		
	});

	$('body').on('click', '.trash', function() {
		$(this).parent().remove();
	});

	$('body').on('click', '.add', function() {
		$("#sortable").append("<li class='wrapper_song'><a class='song'>Nueva canción</a><a class='trash'>x</a></li>");
	});
	
	$('body').on( 'click', 'input', function () {    
    	$(this).focus();
    	$(this).val("");
	});

	// Reveal.initialize({
	// 	history: false,
	// 	width: '100%',
 //    	height: '100%',
 //    	transition:'slide',
 //    	controls:false,
 //    	keyboard:false,
 //    	touch: false,
	// });

	$(".next").click(function(e){
		e.preventDefault();
		Reveal.next();
	});



	
	// Jquery UI sortable
	$( function() {
	    $( "#sortable" ).sortable({
	      revert: true
	    });
	    
	    $( "ul, li" ).disableSelection();
 	 });
	

});





