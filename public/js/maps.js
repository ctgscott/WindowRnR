function mapOne(data) {
//	alert("fired mapOne");
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

function createMaps() {
	function initialize() {
	  var mapOptions = {
		zoom: 4,
		center: new google.maps.LatLng(-33, 151)
	  }
	  var map = new google.maps.Map(document.getElementById('#map_1'),
									mapOptions);

	  var image = 'images/beachflag.png';
	  var myLatLng = new google.maps.LatLng(-33.890542, 151.274856);
	  var beachMarker = new google.maps.Marker({
		  position: myLatLng,
		  map: map,
		  icon: image
	  });
	}

	google.maps.event.addDomListener(window, 'load', initialize);
};