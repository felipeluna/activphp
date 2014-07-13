var map;
var local;

function initialize() {
  var markers = [];

 var mapOptions = {
        zoom: 4,
        center: new google.maps.LatLng(-10,-30)
      };

  map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);

  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('id-endereco-atividade'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      var latitude = place.geometry.location.lat();
      var longitude = place.geometry.location.lng();  

      salveLocation(latitude, longitude);

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

function salveLocation(lat, lng){
  $('input[name="lat"]').val(lat);
  $('input[name="lng"]').val(lng);
}

// function loadScript() {
//   alert('ok1');
//       var script = document.createElement('script');
//       script.type = 'text/javascript';
//       // script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
//       script.src = 'http://maps.google.com/maps/api/js?libraries=places&sensor=false?v=3.exp&' +      
//       'callback=initialize';
//       document.body.appendChild(script);
//   }

// window.onload = loadScript;
$(document).ready(function(){
  var functionname = 'initialize';
  $.getScript("http://maps.google.com/maps/api/js?key=AIzaSyBVZqVVZBg3ZgGEFB8Q4eaxiNnA4EPp3YA&libraries=places&sensor=false&callback="+functionname);
});