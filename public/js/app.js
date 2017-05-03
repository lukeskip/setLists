
$(document).foundation();
$(document).ready(function(){
	var song_counter = 0;
	var song_editing = 0;
	var song_type	 = '';
	var songs 		 = [];
	var songs_update = []

	
	
	// AVISO BETA
	$('body').on('click', '.beta', function() {
		sweetAlert("Así es...", "...aún estamos en fase beta!, si tienes algún problema repórtalo al Rey contacto@reydecibel.com.mx", "warning");
	});

	// BORRAR SETLIST OR SONG
	$('body').on('click', '.trash', function() {
		id 		= $(this).data("id");
		type 	= $(this).data("type");
		song_id	= $(this).data("song_id");
		swal({
		  title: "¿Estás seguro?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DE353A",
		  confirmButtonText: "Aceptar",
		  cancelButtonText: "Cancelar",
		  closeOnConfirm: false
		},
		function(){
			if(type == "setlist_delete"){
				url = "/deleteSetlist/";
			}else if(type == "song_detach"){
				url = "/setlists/";
			}
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: APP_URL + url +id,
				data : {'song_id':song_id,'type':type,'_method':'DELETE'},
				success:function(response)
				{
					
					if(response.status=='success'){
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
					beforeSend: function( xhr ) {
						$('.loader_wrapper').css('display','block');
					},
					url: APP_URL + '/setlists',
					success:function(response)
					{
						console.log(response);
						if(response.status=='success'){
							window.location.replace(APP_URL+'/setlists/'+response.id);
						}else{
							sweetAlert("Esa canción ya existe", "", "error");
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
				console.log(response);
				if(response.status=='success'){
					swal({
					  title: "Listo",
					  text: "Tu setlist fue guardado",
					  type: "success",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "OK!",
					  closeOnConfirm: true
					},
					function(){
					  window.location.replace(APP_URL+'/setlists/'+response.id);
					});
					
				}else{
					sweetAlert("Ese setlist ya existe", "", "error");
				}
			}
		});
	}

	// AGREGAR NUEVA CANCIÓN (SELECCIÓN)
	$('body').on('click', '.add_song', function() {
	
		$('#form_add').foundation('open');
	});

	$('body').on('click', '.song_add_button', function(e) {
		e.preventDefault();
		var position = $( ".song" ).length;
		var id 		 = $('.song_to_add').val();
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'POST',
			data: $('#song_add').serialize()+'&position='+position,
			dataType: "JSON",
			url: APP_URL + '/songs/'+id,
			success:function(response)
			{
				console.log(response);
				if(response.status=='success'){
					swal({
					  title: "Listo",
					  text: "Tu setlist fue guardado",
					  type: "success",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "OK!",
					  closeOnConfirm: true
					},
					function(){
					  window.location.replace(APP_URL+'/setlists/'+response.id);
					});
					
				}else if(response.status=='repeated'){
					sweetAlert("Ya habías agregado esa canción", "", "error");
				}
			}
		});
	});

	// $('body').on('click', '.trash_song', function() {
	// 	$(this).parent().remove();
	// });

	// $('body').on('click', '.song', function() {
	// 	song_editing = $(this).data('id');
	// 	song_type	 = $(this).data('type');
	// 	$('.song_input').val($(this).find('.title').html());
	// });

	$('body').on('click', '.song_input', function() {
		$(this).val("");
	});

	

	$('body').on('click', '.song_save', function() {
		$("#song_save").submit();
	});

	// CREAR UNA NUEVA CANCIÓN

	$('body').on('click', '.create_song', function() {
		$('#form_create').foundation('open');
	});

	$('body').on('submit', '#song_save', function(e) {
		e.preventDefault();
		var position = $( ".song" ).length;
		var form  	 = $('#form_create').find('form');
		$.ajax({
			headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type: 'POST',
			data: $(this).serialize()+'&position='+ position,
			dataType: "JSON",
			url: APP_URL + '/newSong/',
			success:function(response)
			{

				if(response.status=='success'){
					swal({
					  title: "Listo",
					  text: "Tu canción fue creada",
					  type: "success",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "OK!",
					  closeOnConfirm: true
					},
					function(){
					  window.location.replace(APP_URL+'/setlists/'+response.id);
					});
					
				}else{
					console.log("hola");
					sweetAlert("Ese setlist ya existe", "", "error");
				}
			}
		});
		// data_track ();
	});

	

	// ENVIAR SETLIST 
	$('body').on('click', '.send', function() {
		if(songs.length !== 0 || songs_update.length !== 0){
			sweetAlert("Oops...", "Primero guarda los cambios", "error");
		}else{
			$('#form_send').foundation('open');
		}
	});

	$('body').on('click', '.setlist_send', function() {
		
			email 	  = $(".setlist_send_input").val();
			setlis_id = $(".setlist_send_id").val();
			$.ajax({
				headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: 'POST',
					data: {email:email,id:setlis_id},
					dataType: "JSON",
					url: APP_URL + '/send',
					beforeSend: function( xhr ) {
						$('.loader_wrapper').css('display','block');
					},
					success:function(response)
					{
						$('.loader_wrapper').css('display','none');
						console.log(response);

						if(response.status=='success'){
							swal("Listo!", "Tu set list fue enviado.", "success")
						}else{
							sweetAlert("Hubo un error", "Por favor inténtalo más tarde", "error");
						}

						$('#form_send').foundation('close');
					},
					error: function(data) {
						$('.loader_wrapper').css('display','none');
						sweetAlert("Hubo un error en el servidor", "Por favor, Inténtalo de nuevo en unos minutos", "error");
					}
				});
		
	  
	});

	

	//RECABAMOS LA INFORMACIÓN Y LA GUARDAMOS EN OBJETOS
	function data_track (){
		songs 		 = [];
		songs_update = [];
		$( ".song" ).each(function( index ) {
			$(this).data("order",index);
		});
		$( ".song.new" ).each(function( index ) {
			position  = $(this).data("order");
			duration  = $(this).data("duration");
			intencity = $(this).data("intencity");
			title 	  = $(this).find(".title").html();
			songs.push({
				'title' 	: title, 
				'position' 	: position,
				'intencity'	: intencity,
				'duration'	: duration
			});
		});

		$( ".song.old" ).each(function( index ) {
			position = $(this).data("order");
			duration  = $(this).data("duration");
			intencity = $(this).data("intencity");
			title = $(this).find(".title").html();
			id = $(this).data('id');
			songs_update.push({
				'id' 		: id,
				'title' 	: title, 
				'position' 	: position,
				'intencity'	: intencity,
				'duration'	: duration
			});
		});

	}
	
	// Jquery UI sortable

	$( "#sortable" ).sortable({
	  revert: true,
	  stop: function(event, ui) {
		data_track();
		// ui.item.data('order',ui.item.index);
	  }
	});
	
	$( "ul, li" ).disableSelection();
	
	
	$(".duration_slider").slider({
        min: 0,
        max: 600,
        range: 'min',
        step: 10,
        slide: function(e, ui) {
            var hours = Math.floor(ui.value / 60);
            var minutes = ui.value - (hours * 60);

            if(hours.toString().length == 1) hours = '0' + hours;
            if(minutes.toString().length == 1) minutes = '0' + minutes;

            $('.display_slider').html(hours+':'+minutes);
            $('.song_duration').val(hours+':'+minutes);
            
        }
    });

    // SELECT2

    $('.song_to_add').selectize({
    	sortField: 'text'
    });
    $( "input[type=radio]" ).checkboxradio();
	

});





