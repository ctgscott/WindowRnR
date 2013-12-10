var geocoder;
var day;
var markers = [];
/*var LocationData = [
	[49.2812668, -123.1035942, "26 E Hastings St, Vancouver" ], 
	[49.2814064, -123.1025187, "71 E Hastings St, Vancouver" ], 
	[49.2812336, -123.1020622, "122 E Hastings St, Vancouver" ], 
	[49.2813564, -123.1012253, "138 E Hastings St, Vancouver" ], 
	[49.2811625, -123.0985032, "242 E Hastings St, Vancouver" ],
	[49.2811625, -123.0935032, "344 E Hastings St, Vancouver" ]
]; */
var LocationData = [["2544 3rd Street, Santa Monica, CA 90405",	"2314 26th St., Santa Monica, CA  90405"], ['2401 29th St., Santa Monica, CA  90405', '2436 33rd St., Santa Monica, CA  90405']];
/*	[
		"2544 3rd Street, Santa Monica, CA 90405",	
		"2314 26th St., Santa Monica, CA  90405"
	], 
	[
		'2401 29th St., Santa Monica, CA  90405', 
		'2436 33rd St., Santa Monica, CA  90405'
	],
	[
		'2715 Highland Ave, Santa Monica, CA  90405',
		'1424 4th Street, Suite 501, Santa Monica, CA  90401'
	],
	[
		'1514 Yale #3, Santa Monica, CA, 90405',
		'1703 Washington Ave, Santa Monica, CA  90403'
	],
	[
		'549 9th St	Santa Monica, CA  90402',
		'809 Georgina Ave, Santa Monica, CA  90402'
	]
];*/




$(document).ready(function(){
	initMap(1);  
/*	initMap(2);  
	initMap(3);  
	initMap(4);  
	initMap(5);  */
});

function initMap(id) {
	geocoder = new google.maps.Geocoder();
		 
	var map = new google.maps.Map(document.getElementById('map_'+id));
	var bounds = new google.maps.LatLngBounds();
	var infowindow = new google.maps.InfoWindow();
	 
	for (var i in LocationData)
	{
		var p = LocationData[i];
//		var latlng = new google.maps.LatLng(p[0], p[1]);
		alert('p = '+p);
		for (var n in LocationData[i])
		{
			alert('p['+n+'] = '+p[n]);
			var latlng = new google.maps.LatLng(0,0);
			latlng = codeAddress(p[0]);
			alert('latlng = '+latlng);
			bounds.extend(latlng);

			
			
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				//title: p[2]
			});
		}
	 
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(this.title);
			infowindow.open(map, this);
		});
	}
	 
	map.fitBounds(bounds);
	
	//codeAddress('2544 3rd Street, Santa Monica, CA 90274', 1);
}

function codeAddress(address) {
    geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			//alert('results = '+results[0].geometry.location);
			return results[0].geometry.location;
		} else {
        alert("Geocode was not successful for the following reason: " + status);
		}
	});
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