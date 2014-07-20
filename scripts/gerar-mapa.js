
	//variavel q conterá omapa
	var map;

	//adiciona mensagem ao marker do mapa quando clicado
	function attachMessage(marker, message) {
	  var infowindow = new google.maps.InfoWindow({
	    content: message
	  });

	  google.maps.event.addListener(marker, 'click', function() {
	    infowindow.open(marker.get('map'), marker);
	  });
	}

	function initializeMap() {
  		var mapOptions = {
   			zoom: 15
  		};

  		map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

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
				      title: 'Hello World!'
				  });
					attachMessage(marker, "Você está aqui!");
				  map.setCenter(pos);
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

	function loadScript() {
  		var script = document.createElement('script');
  		script.type = 'text/javascript';
  		script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initializeMap';
  		document.body.appendChild(script);
	}

	$(document).ready(loadScript());