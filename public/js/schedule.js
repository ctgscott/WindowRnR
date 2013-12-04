var maps = []; // array for now
//var geocoder;
var id;

$(document).ready(function(){
    google.maps.event.addDomListener(window, 'load', initialize(1)); // two calls
    google.maps.event.addDomListener(window, 'load', initialize(2));
	google.maps.event.addDomListener(window, 'load', initialize(3));
	google.maps.event.addDomListener(window, 'load', initialize(4));
	google.maps.event.addDomListener(window, 'load', initialize(5));
});

function initialize(id) { // Map id for future manipulations
    //geocoder = new google.maps.Geocoder();
    var mapOptions = {
        zoom: 16,
        center: new google.maps.LatLng(50.317408,11.12915),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    maps[id] = new google.maps.Map(document.getElementById('map_'+id), // different containers
        mapOptions);
        codeAddress($('#entityID span#address').text());
}

/*$(document).ready(function(){

	google.maps.event.addDomListener(window, 'load', initialize);

	google.maps.visualRefresh = true;
	
	for (var i=0;i<4;i++)
	{	 
		var map;
		function initialize() {
			var mapOptions = {
				zoom: 8,
				center: new google.maps.LatLng(-34.397, 150.644)
			};
		
			map = new google.maps.Map(document.getElementById('map'+i), mapOptions);
		}
		alert('map'+i);
	}
});
*/