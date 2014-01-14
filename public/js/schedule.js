$(document).ready(function(){
	$('#map_1').gmap().bind('init', function() { 
		var markers = jQuery.parseJSON($('#events1').val());
//		console.log(markers);
		$.each( markers, function(n, marker) {
			var icon = "/img/"+marker.avatar;					
			$('#map_1').gmap('addMarker', { 
				'title': marker.title,
				'position': new google.maps.LatLng(marker.lat, marker.lng), 
				'bounds': true,
				'animation': google.maps.Animation.DROP,
				'icon': icon
			}).click(function() {
				$('#map_1').gmap('openInfoWindow', { 'content': marker.description }, this);
			});
		});
	});

	$('#map_2').gmap().bind('init', function() { 
		var markers = jQuery.parseJSON($('#events2').val());
//		console.log(markers);
		$.each( markers, function(n, marker) {
			var icon = "/img/"+marker.avatar;					
			$('#map_2').gmap('addMarker', { 
				'title': marker.title,
				'position': new google.maps.LatLng(marker.lat, marker.lng), 
				'bounds': true,
				'animation': google.maps.Animation.DROP,
				'icon': icon
			}).click(function() {
				$('#map_2').gmap('openInfoWindow', { 'content': marker.description }, this);
			});
		});
	});

	$('#map_3').gmap().bind('init', function() { 
		var markers = jQuery.parseJSON($('#events3').val());
//		console.log(markers);
		$.each( markers, function(n, marker) {
			var icon = "/img/"+marker.avatar;					
			$('#map_3').gmap('addMarker', { 
				'title': marker.title,
				'position': new google.maps.LatLng(marker.lat, marker.lng), 
				'bounds': true,
				'animation': google.maps.Animation.DROP,
				'icon': icon
			}).click(function() {
				$('#map_3').gmap('openInfoWindow', { 'content': marker.description }, this);
			});
		});
	});

		$('#map_4').gmap().bind('init', function() { 
		var markers = jQuery.parseJSON($('#events4').val());
//		console.log(markers);
		$.each( markers, function(n, marker) {
			var icon = "/img/"+marker.avatar;					
			$('#map_4').gmap('addMarker', { 
				'title': marker.title,
				'position': new google.maps.LatLng(marker.lat, marker.lng), 
				'bounds': true,
				'animation': google.maps.Animation.DROP,
				'icon': icon
			}).click(function() {
				$('#map_4').gmap('openInfoWindow', { 'content': marker.description }, this);
			});
		});
	});

		$('#map_5').gmap().bind('init', function() { 
		var markers = jQuery.parseJSON($('#events5').val());
//		console.log(markers);
		$.each( markers, function(n, marker) {
			var icon = "/img/"+marker.avatar;					
			$('#map_5').gmap('addMarker', { 
				'title': marker.title,
				'position': new google.maps.LatLng(marker.lat, marker.lng), 
				'bounds': true,
				'animation': google.maps.Animation.DROP,
				'icon': icon
			}).click(function() {
				$('#map_5').gmap('openInfoWindow', { 'content': marker.description }, this);
			});
		});
	});
	
	$( "#salescheckbox1" ).click(function() {
		var id = $( "#salescheckbox1" ).val();
		var value = null;
		if($("#salescheckbox1").is(':checked')) {
			value = 1;
		} else {
			value = 0;
		}
		$.post( "/profiles/postSalesCheckBox/", { id: id, value: value });
	});
});