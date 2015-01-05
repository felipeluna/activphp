
	//variavel q conterá omapa
	var map;

	var bounds;
	

	var markers = [];

	//adiciona mensagem ao marker do mapa quando clicado
	function attachMessage(marker, message){
	  var infowindow = new google.maps.InfoWindow({
	    content: message
	  });

	  google.maps.event.addListener(marker, 'click', function() {
	    infowindow.open(marker.get('map'), marker);
	  });
	}

	function attachMessageAtividades(marker, message){
	  var infowindow = new google.maps.InfoWindow({
	    content: message
	  });

	  google.maps.event.addListener(marker, 'click', function() {
	    infowindow.open(marker.get('map'), marker);
	  });
	}


	function initializeMap() {
		bounds = new google.maps.LatLngBounds();

  		var mapOptions = {
   			zoom: 4
  		};

  		map = new google.maps.Map(document.getElementById('map-canvas-atividades'),mapOptions);

	  	// Try HTML5 geolocation
	  	if(navigator.geolocation){
	    	navigator.geolocation.getCurrentPosition(function(position) {
	     		var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

		       	///////////////BEGIN - PINO do usuario NO MAPA
		    	var image = 'images/user-pin.png';
				var marker = new google.maps.Marker({
			      position: pos,
			      map: map,
			      icon: image,
			      title: 'User location'
			  });
				markers.push(marker);
				attachMessage(marker, "Você está aqui!");
				map.setCenter(pos);

				//salva posição do usuário
				$('input[name="user_lat"]').val(position.coords.latitude);
  				$('input[name="user_lng"]').val( position.coords.longitude);


				bounds.extend(marker.position);
				map.fitBounds(bounds);
		    	///////////////END - PINO do usuario NO MAPA - END

	    	},
	    	function() {
	      		handleNoGeolocation(true);
	    	});
	  	}	else {
	    	// Browser doesn't support Geolocation
	    	handleNoGeolocation(false);
	  	}

  	};

  	function handleNoGeolocation(errorFlag) {
		  if (errorFlag) {
		    var content = 'Error: The Geolocation service failed.';
		  } else {
		    var content = 'Error: Your browser doesn\'t support geolocation.';
		  }

		  var options = {
		    map: map,
		    position: new google.maps.LatLng(60, 105),
		    content: content
		  };

		  var infowindow = new google.maps.InfoWindow(options);
		  map.setCenter(options.position);
	}

	// function loadScript() {
 //  		var script = document.createElement('script');
 //  		script.type = 'text/javascript';
 //  		script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
 //      'callback=initializeMap';
 //  		document.body.appendChild(script);
	// }

$(document).ready(function(){

	// loadScript();
	
	initializeMap();

	$('.showonmap').click(function(){
	
		var lat = $(this).parent().find('[name="latitude"]').val();
		var lng = $(this).parent().find('[name="longitude"]').val();

		// alert('lat: '+lat);
		// alert('lng: '+lng);

		var posatividade = new google.maps.LatLng(lat, lng);

		var AtividadeTitle = $(this).parent().find('.name').html();

		var image = 'images/local-30x30.png';

		var marker = new google.maps.Marker({
					      position: posatividade,
					      map: map,
					      icon: image,
					      title: AtividadeTitle
					  });
		// marker.setMap(map);
		markers.push(marker);

		attachMessage(marker, AtividadeTitle);
		// fitMarkers();

		bounds.extend(marker.position);
		map.fitBounds(bounds);
		// map.setCenter(posatividade);
	});


	$('#mapa-off .showonmap').click(function(){
	
		var lat = $(this).parent().find('[name="latitude"]').val();
		var lng = $(this).parent().find('[name="longitude"]').val();

		// alert('lat: '+lat);
		// alert('lng: '+lng);

		var posatividade = new google.maps.LatLng(lat, lng);

		var image = 'images/local-30x30.png';

		var marker = new google.maps.Marker({
					      position: posatividade,
					      map: mapoff,
					      icon: image,
					      title: 'Atividade'
					  });
		// marker.setMap(map);
		markers.push(marker);
		// fitMarkers();

		bounds.extend(marker.position);
		mapoff.fitBounds(bounds);
		// map.setCenter(posatividade);
	});

	$('#dashboard #main-container #content-temp').css("overflow","hidden");
	$('#search-result-com-mapa').css("overflow","auto");

});