var markersArray = [];


function initMap1(events, mapOptions) {
/*	function initialize() {
		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(34.052234, -118.243685)
		};
*/		
		var map1 = new google.maps.Map(document.getElementById('map_1'), mapOptions);
		console.log("map1 = ", map1);
//		setMarkers(map1, events);
		
		var bounds1 = new google.maps.LatLngBounds();
		$.each( events, function(n, event) {
			var myLatLng = new google.maps.LatLng(event.lat, event.lng);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map1,
				icon: '/img/'+event.avatar,
				animation: google.maps.Animation.DROP,
				title: event.title,
			});
			
			markersArray.push(marker);
			console.log(marker);
			bounds1.extend(myLatLng);
			map1.fitBounds(bounds1);
			map1.setCenter(bounds1.getCenter());
			
			var infowindow = new google.maps.InfoWindow({
				content: event.title
			});
			
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map1,marker);
			});

		});
//	};
//	google.maps.event.addDomListener(window, 'load', initialize);
};

function initMap2(events, mapOptions) {
//	function initialize() {
/*		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(34.052234, -118.243685)
		};
*/		var map2 = new google.maps.Map(document.getElementById('map_2'), mapOptions);
		console.log(map2);
//		setMarkers(map2, events);
		var bounds2 = new google.maps.LatLngBounds();
		$.each( events, function(n, event) {
			var myLatLng = new google.maps.LatLng(event.lat, event.lng);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map2,
				icon: '/img/'+event.avatar,
				animation: google.maps.Animation.DROP,
				title: event.title,
			});
			markersArray.push(marker);
			bounds2.extend(myLatLng);
			map2.fitBounds(bounds2);
			map2.setCenter(bounds2.getCenter());
			
			var infowindow = new google.maps.InfoWindow({
				content: event.title
			});
			
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map2,marker);
			});

		});
//	};
//	google.maps.event.addDomListener(window, 'load', initialize);
};

function initMap3(events, mapOptions) {
//	function initialize() {
//		var mapOptions = {
//			zoom: 8,
//			center: new google.maps.LatLng(-34.397, 150.644)
//		};
		var map3 = new google.maps.Map(document.getElementById('map_3'), mapOptions);
//		setMarkers(map3, events);
		var bounds3 = new google.maps.LatLngBounds();
		$.each( events, function(n, event) {
			var myLatLng = new google.maps.LatLng(event.lat, event.lng);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map3,
				icon: '/img/'+event.avatar,
				animation: google.maps.Animation.DROP,
				title: event.title,
			});
			markersArray.push(marker);
			bounds3.extend(myLatLng);
			map3.fitBounds(bounds3);
			map3.setCenter(bounds3.getCenter());
			
			var infowindow = new google.maps.InfoWindow({
				content: event.title
			});
			
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map3,marker);
			});

		});
//	};
//	google.maps.event.addDomListener(window, 'load', initialize);
};

function initMap4(events, mapOptions) {
//	function initialize() {
//		var mapOptions = {
//			zoom: 8,
//			center: new google.maps.LatLng(-34.397, 150.644)
//		};
		var map4 = new google.maps.Map(document.getElementById('map_4'), mapOptions);
//		setMarkers(map4, events);
		var bounds4 = new google.maps.LatLngBounds();
		$.each( events, function(n, event) {
			var myLatLng = new google.maps.LatLng(event.lat, event.lng);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map4,
				icon: '/img/'+event.avatar,
				animation: google.maps.Animation.DROP,
				title: event.title,
			});
			markersArray.push(marker);
			bounds4.extend(myLatLng);
			map4.fitBounds(bounds4);
			map4.setCenter(bounds4.getCenter());
			
			var infowindow = new google.maps.InfoWindow({
				content: event.title
			});
			
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map4,marker);
			});

		});
//	};
//	google.maps.event.addDomListener(window, 'load', initialize);
};

function initMap5(events, mapOptions) {
//	function initialize() {
//		var mapOptions = {
//			zoom: 8,
//			center: new google.maps.LatLng(-34.397, 150.644)
//		};
		var map5 = new google.maps.Map(document.getElementById('map_5'), mapOptions);
//		setMarkers(map5, events);
		var bounds5 = new google.maps.LatLngBounds();
		$.each( events, function(n, event) {
			var myLatLng = new google.maps.LatLng(event.lat, event.lng);
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map5,
				icon: '/img/'+event.avatar,
				animation: google.maps.Animation.DROP,
				title: event.title,
			});
			markersArray.push(marker);
			bounds5.extend(myLatLng);
			map5.fitBounds(bounds5);
			map5.setCenter(bounds5.getCenter());
			
			var infowindow = new google.maps.InfoWindow({
				content: event.title
			});
			
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map5,marker);
			});

		});
	console.log("markersArray (before) = ", markersArray);
//	};
//	google.maps.event.addDomListener(window, 'load', initialize);
};

function mapDay(events, mapOptions) {
	console.log("mapDay fired with events = ", events);
	var mapDay = new google.maps.Map(document.getElementById('map_day'), mapOptions);
	
	var boundsDay = new google.maps.LatLngBounds();
	$.each( events, function(n, event) {
		var myLatLng = new google.maps.LatLng(event.lat, event.lng);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: mapDay,
			icon: '/img/'+event.avatar,
			animation: google.maps.Animation.DROP,
			title: event.title,
		});
		
		markersArray.push(marker);
		console.log(marker);
		boundsDay.extend(myLatLng);
		mapDay.fitBounds(boundsDay);
		mapDay.setCenter(boundsDay.getCenter());
		
		var infowindow = new google.maps.InfoWindow({
			content: event.title
		});
		
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(mapDay,marker);
		});

	});
};

function setMarkers(map, events) {
//	alert('called setMarkers');
	console.log("setMarkers for map: "+map+" - events = "+events);
	odump(events);
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

function odump(o){
   console.log($.parseJSON(JSON.stringify(o)));
}

function removeMarkers() {
	$.each( markersArray, function(n) {
		this.setMap(null);
	});	
	//markersArray = [];
	console.log("markersArray (after) = ", markersArray);
};


	
