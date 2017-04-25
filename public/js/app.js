
$(document).foundation();
$(document).ready(function(){
	var song_counter = 0;
	var song_editing = 0;
	var song_type	 = '';
	var songs 		 = [];
	var songs_update = []


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


	// BORRAR SETLIST OR SONG
	$('body').on('click', '.trash', function() {
		id 		= $(this).data("id");
		type 	= $(this).data("type");
		swal({
		  title: "¿Estás seguro de querer borrar este item?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DE353A",
		  confirmButtonText: "Aceptar",
		  cancelButtonText: "Cancelar",
		  closeOnConfirm: false
		},
		function(){
			if(type == "setlist"){
				url = /deleteSetlist/;
			}else{
				url = /deleteSong/;
			}
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: APP_URL + url+id,
				success:function(response)
				{
					if(response=='success'){
						location.reload();
					}
				}
			});
		  
		});
		
	});

	// CREAR SETLIST 
	$('body').on('click', '.submit', function() {
		$(this).parent().submit();		  
	});

	$(document).on('submit','#add_setlist',function(e){
		e.preventDefault();
		type 	= $(this).data("type");
		if(type == "setlist"){
			if($('#name').val()!=''){
				$.ajax({
					type: 'POST',
					data: $('#add_setlist').serialize(),
					dataType: "JSON",
					url: APP_URL + '/setlists/',
					success:function(response)
					{
					
						if(response.status=='success'){
							window.location.replace(APP_URL+'/setlists/'+response.id);
						}else{
							sweetAlert("Ese setlist ya existe", "", "error");
						}
					}
				});

			}else{
				sweetAlert("Oops...", "El campo de título está vacío", "error");
			}
			
		}
	});


	// EDITAR SETLIST Y GUARDAR CANCIONES
	$('body').on('click', '.edit', function() {
		$('#form_update').foundation('open');		  
	});

	$(document).on('submit','#update_setlist',function(e){
		e.preventDefault();	
		if($('#name').val()!=''){
			update_setlist('title');
		}else{
			sweetAlert("Oops...", "El campo de título está vacío", "error");
		}
	});

	$('body').on('click', '.save', function() {
		if(songs.length === 0 && songs_update.length === 0){
			sweetAlert("Oops...", "No hay cambios que guardar", "error");
		}else{
			update_setlist('songs');
		}
		
	});



	function update_setlist(type){
		id = $('input[name=id]').val();

		if(type=='title'){
			data = $('#update_setlist').serialize();
		}else if(type='songs'){
			data = $('#update_setlist').serialize()+'&songs=' + JSON.stringify(songs)+ '&songs_update=' + JSON.stringify(songs_update);
		}

		
		$.ajax({
			type: 'POST',
			data: data,
			dataType: "JSON",
			url: APP_URL + '/setlists/'+id,
			success:function(response)
			{

				if(response.status=='success'){
					window.location.replace(APP_URL+'/setlists/'+response.id);
				}else{
					sweetAlert("Ese setlist ya existe", "", "error");
				}
			}
		});
	}

	// AGREGAR NUEVA CANCIÓN
	$('body').on('click', '.add_song', function() {
		song_counter++;
		$(".list_rey").append('<li class="song new" data-type="new" data-order="0" data-id="'+song_counter+'"><span class="title">Canción nueva</span><div class="trash_song"><i class="fa fa-trash" aria-hidden="true"></i></div></li>')
	});

	$('body').on('click', '.trash_song', function() {
		$(this).parent().remove();
	});

	$('body').on('click', '.song', function() {
		song_editing = $(this).data('id');
		song_type	 = $(this).data('type');
		$('.song_input').val($(this).find('.title').html());
		$('#form_create').foundation('open');
	});

	$('body').on('click', '.song_input', function() {
		$(this).val("");
	});

	$('body').on('submit', '#song_save', function(e) {
		e.preventDefault();
		title_song = $(".song_input").val();
		$('.song.'+ song_type +'[data-id="'+song_editing+'"]').find('.title').html(title_song);
		$('.song_input').val("");
		$('#form_create').foundation('close');
		data_track ();
	});

	$('body').on('click', '.song_save', function() {
		$("#song_save").submit();
	});


	// ENVIAR SETLIST 
	$('body').on('click', '.send', function() {
		email 	  = $(this).data('email');
		setlis_id = $(this).data('id');
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				data: {email:'contacto@chekogarcia.com.mx',id:setlis_id},
				dataType: "JSON",
				url: APP_URL + '/send/',
				beforeSend: function( xhr ) {
    				$('.loader_wrapper').css('display','block');
  				},
				success:function(response)
				{
					$('.loader_wrapper').css('display','none');
					console.log(response);

					if(response.status=='success'){
						swal("Listo!", "Tu set list fue enviado a tu correo electrónico!", "success")
					}else{
						sweetAlert("Ese setlist ya existe", "", "error");
					}
				}
			});
	  
	});

	

	//RECABAMOS LA INFORMACIÓN Y LA GUARDAMOS EN OBJETOS
	function data_track (){
		$( ".song" ).each(function( index ) {
			$(this).data("order",index);
		});
		$( ".song.new" ).each(function( index ) {
			position = $(this).data("order");
			title = $(this).find(".title").html();
			songs.push({
				'title' 	: title, 
				'position' 	: position
			});
		});

		$( ".song.old" ).each(function( index ) {
			position = $(this).data("order");
			title = $(this).find(".title").html();
			id = $(this).data('id');
			songs_update.push({
				'id' 		: id,
				'title' 	: title, 
				'position' 	: position
			});
		});
	}
	
	// Jquery UI sortable
	$( function() {
		$( "#sortable" ).sortable({
		  revert: true,
		  stop: function(event, ui) {
			data_track();
			// ui.item.data('order',ui.item.index);
		  }
		});
		
		$( "ul, li" ).disableSelection();
	 });
	
	

});





