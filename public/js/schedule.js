//var geocoder;
//var day;
//var markers = [];
/*var LocationData = [
	[49.2812668, -123.1035942, "26 E Hastings St, Vancouver" ], 
	[49.2814064, -123.1025187, "71 E Hastings St, Vancouver" ], 
	[49.2812336, -123.1020622, "122 E Hastings St, Vancouver" ], 
	[49.2813564, -123.1012253, "138 E Hastings St, Vancouver" ], 
	[49.2811625, -123.0985032, "242 E Hastings St, Vancouver" ],
	[49.2811625, -123.0935032, "344 E Hastings St, Vancouver" ]
]; */
//var LocationData = [["2544 3rd Street, Santa Monica, CA 90405",	"2314 26th St., Santa Monica, CA  90405"], ['2401 29th St., Santa Monica, CA  90405', '2436 33rd St., Santa Monica, CA  90405']];
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
	initMap(2);  
	initMap(3);  
	initMap(4);  
	initMap(5);  
	
	addMarkers(1);
	addMarkers(2);
});

function initMap(id) {

	$("#map_"+id).goMap({
		zoom:9,
		address: 'Los Angeles, CA',
		maptype: 'ROADMAP',
		scaleControl: true
	});
};

function addMarkers(id) {
	$("#map_"+id).goMap({});
	
	$.get('/positions'+id+'.json', function(data) {
		for(var i = 0, l = data.positions.length; i < l; i++) {
			var marker = data.positions[i];

			$.goMap.createMarker({
				latitude: marker.latitude,
				longitude: marker.longitude,
				title: marker.device_label
			});
			
			$.goMap.fitBounds();
		}
		
//			alert(n);
	}, 'json');
};


/*
	$.get('/positions.json', function(data) {
		for(var i = 0, l = data.positions.length; i < l; i++) {
			var marker = data.positions[i];

			$.goMap.createMarker({
				latitude: marker.latitude,
				longitude: marker.longitude,
				title: marker.device_label
			});
			
			$.goMap.fitBounds();
		}
	}, 'json');
	
	$(this).attr("disabled","disabled");
};
*/

/*
var myMaps = [];


$(document).ready(function(){
	
	function buildMap(n) {
	//	alert(n);
		return function(n) {
			$("#map_"+n).goMap({
				zoom:9,
				address: 'Los Angeles, CA',
				maptype: 'ROADMAP',
				scaleControl: true
			});

			$.get('/positions'+n+'.json', function(data) {
				for(var i = 0, l = data.positions.length; i < l; i++) {
					var marker = data.positions[i];

					$.goMap.createMarker({
						latitude: marker.latitude,
						longitude: marker.longitude,
						title: marker.device_label
					});
					
					$.goMap.fitBounds();
				}
				
		//			alert(n);
			}, 'json');

			
			//$(this).attr("disabled","disabled");
		};
		console.log('myMaps #'+n+' '+myMaps[n]);
	}
	
	for (n = 1; n < 6; n++) {
		myMaps[n] = buildMap(n);
	}
	
	for (var j = 1; j < 6; j++) {
		myMaps[j](j);
	}
});




/*	geocoder = new google.maps.Geocoder();
		 
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
			var latlng = new google.maps.LatLng(0, 0);
/*			latlng = geocoder.geocode( { 'address': p[n]}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					alert('results = '+results[0].geometry.location);
					alert('results.lat() = '+results[0].geometry.location.lat());
					alert('results.lng() = '+results[0].geometry.location.lng());
//					return results[0].geometry.location;
				} else {
				alert("Geocode was not successful for the following reason: " + status);
				}
			});
*/
/*			var latlng = codeAddress(p[n], function(makeMarker) {;
				var marker = new google.maps.Marker({
					position: latlng,
					map: map,
					//title: p[2]
				});
			});
//			var latlng = new google.maps.LatLng(codeAddress(p[0]).lat(), codeAddress(p[0]).lng());
//			var latlng = codeAddress('2544 3rd Street, Santa Monica, CA  90405');
//			var test = new google.maps.LatLng(latlng.lat(), latlng.lng());
			alert('latlng = '+latlng);
//			alert('test = '+test);
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

function codeAddress(address, callback) {
    geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			alert('results = '+results[0].geometry.location);
			alert('results.lat() = '+results[0].geometry.location.lat());
			alert('results.lng() = '+results[0].geometry.location.lng());
//			return results[0].geometry.location;
			
		} else {
        alert("Geocode was not successful for the following reason: " + status);
		}
	});
}
*/	
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