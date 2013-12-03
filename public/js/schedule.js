$(document).ready(function(){
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

		google.maps.event.addDomListener(window, 'load', initialize);
	}
});
