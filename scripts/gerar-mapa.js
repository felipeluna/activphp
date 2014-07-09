
	//variavel q conterá omapa
	var map;

	// //variavel de estilizar o mapa
	// var MY_MAPTYPE_ID = 'custom_style';

	// //estilizando mapa
	// var featureOpts = [
	//     {
	//       stylers: [
	//         { hue: '#890000' },
	//         { visibility: 'simplified' },
	//         { gamma: 0.5 },
	//         { weight: 0.5 }
	//       ]
	//     },
	//     {
	//       elementType: 'labels',
	//       stylers: [
	//         { visibility: 'off' }
	//       ]
	//     },
	//     {
	//       featureType: 'water',
	//       stylers: [
	//         { color: '#890000' }
	//       ]
	//     }
	//   ];

	function initialize() {
  		var mapOptions = {
   			zoom: 15
  		};

  		map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

	  	// Try HTML5 geolocation
	  	if(navigator.geolocation) {
	    	navigator.geolocation.getCurrentPosition(function(position) {
	     		var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

		    	var infowindow = new google.maps.InfoWindow({
	        		map: map,
	        		position: pos,
	        		content: 'Você está aqui'});
		    	map.setCenter(pos);
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
      'callback=initialize';
  		document.body.appendChild(script);
	}

	$(document).ready(loadScript())