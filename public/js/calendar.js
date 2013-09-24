$(document).ready(function() {

	/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events div.external-event').each(function() {
	
		// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
		// it doesn't need to have a start or end
		var eventObject = {
			title: $.trim($(this).text()) // use the element's text as the event title
		};
		
		// store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject);
		
		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
		
	});


	// page is now ready, initialize the calendar...
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();


	$('#calendar').fullCalendar({
		// put your options and callbacks here
		
		droppable: true, // this allows things to be dropped onto the calendar !!!
		drop: function(date, allDay) { // this function is called when something is dropped
		
			// retrieve the dropped element's stored Event Object
			var originalEventObject = $(this).data('eventObject');
			
			// we need to copy it, so that multiple events don't have a reference to the same object
			var copiedEventObject = $.extend({}, originalEventObject);
			
			// assign it the date that was reported
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			
			// render the event on the calendar
			// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
		},
		
/*		dayClick: function(date, allDay, jsEvent, view) {
			//alert('a day has been clicked!');
			//$('#myModal').modal('show')
			if (allDay) {
				alert('Clicked on the map');
			}else{
				//alert('Clicked on the slot: ' + date);

				//$(this).css('background-color', 'red');

				var selectdate = $.fullCalendar.formatDate(date, "yyyy-MM-dd");
				var selecttime = $.fullCalendar.formatDate(date, "hh:mm tt");
							
				$('#schedulebox').dialog({
					create: function(event, ui) { 
						var widget = $(this).dialog("widget");
						$(".ui-dialog-titlebar-close", widget).addClass("ui-icon-closethick");
					},
					autoOpen: false,
					height: 550,
					width: 600,
					title: 'Reserve meeting room on ' + selectdate + ' @ ' + selecttime,
					modal: true,
					position: "center",
					draggable: false,
					buttons: {
						"Schedule": function() {				
							var duration = $("#arrivalWindow").val();
							var calendarName = $("#calendarName").val();
							var summary = $("#summary").val();
							var location = $("#location").val();
							var description = $("#notes").val();
							
							alert('$calendarID: ' + calendarName + ', $start: ' + date + ', $end: ' + end + ', $summary: ' + summary + ', $location: ' + location + ', $description: ' + description);
						},
						"Cancel": function() {
							$( this ).dialog( "close" );
						},
						"Edit Lead": function() {
						//	var id = $customer->job_id;
						//	$.get("/customers/" + id);
							document.location.href='/customers/1';
						}
					},
					open: function() {
						$('.ui-dialog-buttonpane').find('button:contains("Schedule")').addClass('btn btn-success');
						$('.ui-dialog-buttonpane').find('button:contains("Cancel")').addClass('btn btn-primary');
						$('.ui-dialog-buttonpane').find('button:contains("Edit Lead")').addClass('btn btn-info');
					}
				});
				
				$( "#schedulebox" ).dialog( "open" );
				return false;

			}
		},
*/
		selectable: true,
		selectHelper: true,
/*		select: function(start, end, allDay) {
			var title = prompt('Event Title:');
			if (title) {
				$('#calendar').fullCalendar('renderEvent',
					{
						title: title,
						start: start,
						end: end,
						allDay: allDay
					},
					true // make the event "stick"
				);
			}
			$('#calendar').fullCalendar('unselect');
		},
*/
		select: function(start, end, allDay) {
			$('#schedulebox').dialog({
				create: function(event, ui) { 
					var widget = $(this).dialog("widget");
					$(".ui-dialog-titlebar-close", widget).addClass("ui-icon-closethick");
				},
				autoOpen: false,
				height: 550,
				width: 600,
				title: 'Reserve meeting room on ' + date + ' @ ' + start,
				modal: true,
				position: "center",
				draggable: false,
				buttons: {
					"Schedule": function() {				
						var duration = $("#arrivalWindow").val();
						var calendarName = $("#calendarName").val();
						var summary = $("#summary").val();
						var location = $("#location").val();
						var description = $("#notes").val();
					
						//alert('$calendarID: ' + calendarName + ', $start: ' + start + ', $end: ' + end + ', $summary: ' + summary + ', $location: ' + location + ', $description: ' + description);
						
						var googleInsert = {};
						googleInsert['calendarID'] = calendarName;
						googleInsert['summary'] = summary;
						googleInsert['location'] = location;
						googleInsert['start'] = start;
						googleInsert['end'] = end;
						googleInsert['description'] = description;
						
						//alert(JSON.stringify(googleInsert));
						$.ajax({
							type: "POST",
							url: '/customers/postGoogleInsert',
							data: googleInsert,
							success: function(data) {
								//$("#calendar").fullCalendar("refetchEvents");
								window.location.reload();
							}
						});
						//This will close the popup div form
						$( this ).dialog( "close" );
					},
					"Cancel": function() {
						$( this ).dialog( "close" );
					},
					"Edit Lead": function() {
					//	var id = $customer->job_id;
					//	$.get("/customers/" + id);
						document.location.href='/customers/1';
					}
				},
				open: function() {
					$('.ui-dialog-buttonpane').find('button:contains("Schedule")').addClass('btn btn-success');
					$('.ui-dialog-buttonpane').find('button:contains("Cancel")').addClass('btn btn-primary');
					$('.ui-dialog-buttonpane').find('button:contains("Edit Lead")').addClass('btn btn-info');
				}
			});
			
			$( "#schedulebox" ).dialog( "open" );
			return false;
		},


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
				type: 'GET',
/*				data: {
				start: startParam, //	custom_param1: 'something',
				end: startParam //	custom_param2: 'somethingelse'
				},
*/				color: 'blue',    // an option!
				textColor: 'white',  // an option!
				error: function() {
					alert('there was an error while fetching estimageschedule!');
				}
			},
			{
				url: '/customers/estimateschedule2',
				type: 'GET',
/*				data: {
					basstart: 'start',
					blah: 'end'
				},
*/				color: 'green',    // an option!
				textColor: 'white',  // an option!
				error: function() {
					alert('there was an error while fetching estimageschedule2!');
				}
			}
		]
	});
	
});
