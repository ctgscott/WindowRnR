$(document).ready(function(){
	$('#map_day').hide();

	$('#map_1').gmap().bind('init', function() { 
		var markers = jQuery.parseJSON($('#events1').val());
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
	
/*	$('#map_day').gmap().bind('init', function() { 
		var markers = jQuery.parseJSON($('#events5').val());
		$.each( markers, function(n, marker) {
			var icon = "/img/"+marker.avatar;					
			$('#map_day').gmap('addMarker', { 
				'title': marker.title,
				'position': new google.maps.LatLng(marker.lat, marker.lng), 
				'bounds': true,
				'animation': google.maps.Animation.DROP,
				'icon': icon
			}).click(function() {
				$('#map_day').gmap('openInfoWindow', { 'content': marker.description }, this);
			});
		});
	});
*/	

	$( "#salescheckbox1" ).click(function() {
		var id = $( "#salescheckbox1" ).val();
		var value = null;
		if($("#salescheckbox1").is(':checked')) {
			value = 1;
		} else {
			value = 0;
		}
		$.post( "/profiles/postSalesCheckBox", { id: id, value: value });
	});

	$( "#salescheckbox2" ).click(function() {
		var id = $( "#salescheckbox2" ).val();
		var value = null;
		if($("#salescheckbox2").is(':checked')) {
			value = 1;
		} else {
			value = 0;
		}
		$.post( "/profiles/postSalesCheckBox", { id: id, value: value });
	});

	$( "#salescheckbox3" ).click(function() {
		var id = $( "#salescheckbox3" ).val();
		var value = null;
		if($("#salescheckbox3").is(':checked')) {
			value = 1;
		} else {
			value = 0;
		}
		$.post( "/profiles/postSalesCheckBox", { id: id, value: value });
	});
	
	$( "#reset_page" ).click(function() {
		    location.reload();
	});
	
	$( ".fc-button-agendaDay" ).click(function() {
		$('#map_container').hide();
//		$('.fc-today').width('475px');
		$('#calendar').width('49%');
		$('.fc-header').width('1130px');
//		$(window).trigger("resize");
		$('#calendar').fullCalendar('option', 'aspectRatio', .8);
		$('#calendar').fullCalendar('render');
		$('#map_day').show();
//		google.maps.event.trigger(map_day, "resize");

		$('#map_day').gmap().bind('init', function() { 
			var markers = jQuery.parseJSON($('#events1').val());
			$.each( markers, function(n, marker) {
				var icon = "/img/"+marker.avatar;					
				$('#map_day').gmap('addMarker', { 
					'title': marker.title,
					'position': new google.maps.LatLng(marker.lat, marker.lng), 
					'bounds': true,
					'animation': google.maps.Animation.DROP,
					'icon': icon
				}).click(function() {
					$('#map_day').gmap('openInfoWindow', { 'content': marker.description }, this);
				});
			});
		});
	});

	$( ".fc-button-agendaWeek" ).click(function() {
		$('#map_container').show();
		$('#calendar').width('100%');
		$('#calendar').fullCalendar('render');
		$('#map_day').hide();
	});

	$( ".fc-button-month" ).click(function() {
		$('#map_container').hide();
		$('#calendar').width('100%');
		$('#calendar').fullCalendar('render');
		$('#map_day').hide();
	});

	$( "#rerender" ).click(function() {
		$('#calendar').fullCalendar('render');
		alert('sheisse');
	});
});