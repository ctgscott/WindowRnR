var markersArray = [];

function mapOne(data) {
//	alert("fired mapOne");
//	alert(data);
	$('#map_1').gmap().bind('init', function() { 
		$.each( data, function(n, item) {
			var icon = "/img/"+item.avatar;		
			$('#map_1').gmap('addMarker', { 
				'title': item.title,
				'position': new google.maps.LatLng(item.lat, item.lng), 
				'bounds': true,
				'animation': google.maps.Animation.DROP,
				'icon': icon
			}).click(function() {
				$('#map_1').gmap('openInfoWindow', { 'content': item.description }, this);
			});
		});
	});
};

/*function initMap2(events) {
	alert('called initMap');
//	google.maps.visualRefresh = true;

//	var map;
	function initialize() {
		alert('initMap #2');
		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(-34.397, 150.644)
		};
		var map = new google.maps.Map(document.getElementById('map_one'), mapOptions);
		setMarkers(map, events);
	};

	google.maps.event.addDomListener(window, 'load', initialize);
};
*/
function initMap1(events) {
	function initialize() {
//			alert('map_3');
		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(-34.397, 150.644)
		};
		var map = new google.maps.Map(document.getElementById('map_1'), mapOptions);
		setMarkers(map, events);
	};
	google.maps.event.addDomListener(window, 'load', initialize);
};

function initMap2(events) {
	function initialize() {
//			alert('map_3');
		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(-34.397, 150.644)
		};
		var map = new google.maps.Map(document.getElementById('map_2'), mapOptions);
		setMarkers(map, events);
	};
	google.maps.event.addDomListener(window, 'load', initialize);
};

function initMap3(events) {
	function initialize() {
		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(-34.397, 150.644)
		};
		var map = new google.maps.Map(document.getElementById('map_3'), mapOptions);
		setMarkers(map, events);
	};
	google.maps.event.addDomListener(window, 'load', initialize);
};

function initMap4(events) {
	function initialize() {
		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(-34.397, 150.644)
		};
		var map = new google.maps.Map(document.getElementById('map_4'), mapOptions);
		setMarkers(map, events);
	};
	google.maps.event.addDomListener(window, 'load', initialize);
};

function initMap5(events) {
	function initialize() {
		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(-34.397, 150.644)
		};
		var map = new google.maps.Map(document.getElementById('map_5'), mapOptions);
		setMarkers(map, events);
	};
	google.maps.event.addDomListener(window, 'load', initialize);
};

function setMarkers(map, events) {
//	alert('called setMarkers');
	console.log("setMarkers - events = "+events);
	var bounds = new google.maps.LatLngBounds();
	$.each( events, function(n, event) {
		var myLatLng = new google.maps.LatLng(event.lat, event.lng);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			icon: '/img/'+event.avatar,
		    animation: google.maps.Animation.DROP,
			title: event.title,
		});
		bounds.extend(myLatLng);
		map.fitBounds(bounds);
		map.setCenter(bounds.getCenter());
		
		var infowindow = new google.maps.InfoWindow({
			content: event.title
		});
		
		google.maps.event.addListener(marker, 'click', function() {
		    infowindow.open(map,marker);
		});

	});
};

function clearMarkers() {
  for (var i = 0; i < markersArray.length; i++ ) {
    markersArray[i].setMap(null);
  }
  markersArray.length = 0;
}