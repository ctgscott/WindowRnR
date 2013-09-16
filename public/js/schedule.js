$(document).ready(function(){
	$("[rel=drevil]").popover({
		placement : 'bottom', //placement of the popover. also can use top, bottom, left or right
		title : '<div style="text-align:center; color:red; text-decoration:underline; font-size:14px;"> Muah ha ha</div>', //this is the top title bar of the popover. add some basic css
		html: 'true', //needed to show html of course
		content : '<div id="popOverBox"><img src="http://www.hd-report.com/wp-content/uploads/2008/08/mr-evil.jpg" width="251" height="201" /></div>' //this is the content of the html box. add the image here or anything you want really.
	});

    $(':button.test').click(function(){
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		var data = {};
		var eventsJSONObject = {"events": 
			[
				{
					"title": "(Long Beach) Anderson",
					"start": new Date(y, m, 19, 11, 00),
					"end": new Date(y, m, 19, 12, 00),
					"allDay": false,
					"url": "http://www.google.com"
				},
				{
					"title": "(Long Beach) Baker",
					"start": new Date(y, m, 20, 11, 00),
					"end": new Date(y, m, 20, 12, 00),
					"allDay": false,
					"url": "http://www.google.com"
				}
			]
		};
		
/*		$.post(
			"/customers/estimateschedule",
			function(data) {
				//$.extend(eventsJSONObject, data);
				alert(data);
				jQuery.parseJSON(data);
				$('#calendar').fullCalendar('addEventSource',data);
				alert(data);
			}
		);
*/		
	//	alert(JSON.stringify(eventsJSONObject));
	
		$('#calendar').fullCalendar('addEventSource',eventsJSONObject);
	//	$('#calendar').fullCalendar('addEventSource','/customers/estimateschedule');

	});
});
