$(document).ready(function(){

	$("#map_1").goMap({zoom:10});

//	$("#count1").click(function() {

		$.get('/positions.json', function(data) {
//			for(var i in data.positions) {
			for(var i = 0, l = data.positions.length; i < l; i++) {
				var marker = data.positions[i];

				$.goMap.createMarker({
					latitude: marker.latitude,
					longitude: marker.longitude,
					title: marker.device_label
				});
			}
		}, 'json');

		$(this).attr("disabled","disabled");
//	});

});