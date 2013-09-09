$(document).ready(function() {

	// page is now ready, initialize the calendar...
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();


	$('#calendar').fullCalendar({
		// put your options and callbacks here
		
		dayClick: function(date, allDay, jsEvent, view) {
			//alert('a day has been clicked!');
			//$('#myModal').modal('show')
/*			if (allDay) {
				alert('Clicked on the entire day: ' + date);
			}else{
				alert('Clicked on the slot: ' + date);
			}

			alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
*/
			alert('Current view: ' + view.name);
			this.popover({
				placement : 'bottom', //placement of the popover. also can use top, bottom, left or right
				title : '<div style="text-align:center; color:red; text-decoration:underline; font-size:14px;"> Muah ha ha</div>', //this is the top title bar of the popover. add some basic css
				html: 'true', //needed to show html of course
				content: '<div id="popOverBox"><img src="http://www.hd-report.com/wp-content/uploads/2008/08/mr-evil.jpg" width="251" height="201" /></div>' //this is the content of the html box. add the image here or anything you want really.
			});
						
			// change the day's background color just for fun
			//$(this).css('background-color', 'red');
		},
		weekends: false, 	// will hide Saturdays and Sundays
		weekends: false, 	// will hide Saturdays and Sundays
		editable: true,  	// enables drag, drop and resize
		weekMode: 'liquid',
		titleFormat: {
			week: "MMM d[ yyyy]{ '&#8212;'[ MMM] d, yyyy}",
			day: 'dddd, MMM d, yyyy'
		},
		url:'http://localhost:8000/customers/estimateschedule/',
		allDayText: 'Map',
		minTime: 7,
		maxTime: 19,
		header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
		},
		defaultView: 'agendaWeek',
		
		eventClick: function(event) {
        // opens events in a popup window
        window.open(event.url, 'gcalevent', 'width=700,height=600');
        return false;
		},		
		
/*		eventClick: function(event) {
			if (event.url) {
				window.open(event.url);
				return false;
			}
		},
*/
		eventMouseover: function(event, jsEvent, view){
			var eventid = event.id;
			var layer = $("<div id='events-layer'  style='position:absolute; top:" + jsEvent.pageY +"px; left:"+ jsEvent.pageX + "px; text-align:left; z-index:9999;background-color:#ffffff;padding-right:5px;cursor:pointer;width:100px;color:#000000;'><ul style='list-style-type: none;margin-left:0px;padding:0px;overflow:hidden;' onclick=''><li onClick='editEvent("+ eventid +");'><a><i class='icon-wrench'></i></a>&nbsp;<?php echo 'Rediger vagt' ?></li><li onClick='showEventMembers("+ eventid +");'><a><i class='icon-user'></i></a>&nbsp;<?php echo 'Vis tilmeldte' ?></li><li onClick='emailEventMembers("+ eventid +");'><a><i class='icon-envelope'></i></a>&nbsp;<?php echo 'Skriv mail' ?></li><li onClick='printShiftplan("+ eventid +");'><a><i class='icon-print'></i></a>&nbsp;<?php echo 'Udskriv vagtplan' ?></li><li onClick='deleteEvent("+ eventid +");'><a><i class='icon-trash'></i></a>&nbsp;<?php echo 'Slet vagt' ?></li></ul></div>");

			layer.mouseenter(function(){
			   $(this).addClass("mouse_in");
			})

			layer.mouseleave(function(){
			   $(this).remove();
			})

			$("body").append(layer);

			console.log(jsEvent);
        },

        eventMouseout: function(calEvent, domEvent) {
			if(!$("#events-layer").hasClass('mouse_in')){
				$("#events-layer").remove();
			}
        },
		
/*		events: {
			url: '/customers/estimateschedule',
			type: 'POST',
			data: {
				//custom_param1: 'something',
				//custom_param2: 'somethingelse'
			},
			error: function() {
				alert('there was an error while fetching events!');
			},
			//color: 'yellow',   // a non-ajax option
			//textColor: 'black' // a non-ajax option
			
		},
*/		
		eventSources: [
			{
				url: '/customers/estimateschedule',
				type: 'POST',
				color: 'blue',    // an option!
				textColor: 'white',  // an option!
				error: function() {
					alert('there was an error while fetching events!');
				}
			},
			{
				url: '/customers/estimateschedule2',
				type: 'POST',
				color: 'green',    // an option!
				textColor: 'white',  // an option!
				error: function() {
					alert('there was an error while fetching events!');
				}
			}
		]
	});

});
