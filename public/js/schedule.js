var cal1 = [];
var cal2 = [];
var cal3 = [];
var eventsList = [];
var date = new Date(), y = date.getFullYear(), m = date.getMonth();
var firstDay = new Date(y, m, 1);
var lastDay = new Date(y, m + 1, 0);
var firstTime = firstDay.getTime();
var lastTime = lastDay.getTime();

$.get( "/events/getCalEvents/"+firstTime+"/"+lastTime, function( data ) {
//	console.log(data);
//		n = cal1.push("peach");
	$(data).each(function(index) {
//		console.log(this);
		
		if ( this.cal_user_id == 1) {
//			console.log("#1");
			cal1.push(this);
		} else if ( this.cal_user_id == 2) {
//			console.log("#2");
			cal2.push(this);
		} else if ( this.cal_user_id == 3) {
//			console.log("#3");
			cal3.push(this);
		}
	});
//console.log(cal1);
//console.log(cal2);
//console.log(cal3);
});


$(document).ready(function(){
	/* Full Calendar - initialize the external events
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
	
/*	if ($("#cal1").val() == "none") {
		var cal1 = null;
	} else {
		var cal1 = jQuery.parseJSON($("#cal1").val());
	}
	
	if ($("#cal2").val() == "none") {
		var cal2 = null;
	} else {
		var cal2 = jQuery.parseJSON($("#cal2").val());
	}
	
	if ($("#cal3").val() == "none") {
		var cal3 = null;
	} else {
		var cal3 = jQuery.parseJSON($("#cal3").val());
	}
*/	
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

		selectable: true,
		selectHelper: true,
		select: function(start, end, allDay) {
			$('#schedulebox').dialog({
				create: function(event, ui) { 
					var widget = $(this).dialog("widget");
					$(".ui-dialog-titlebar-close", widget).addClass("ui-icon-closethick");
					$(".ui-dialog-titlebar-close", widget).attr('id', 'titlebar');
					
					var insertTime = $(this).dialog("widget");
					$("#startTime", insertTime).append(moment(start).format("MM/DD/YYYY, hh:mm a"));
					$("#endTime", insertTime).append(moment(end).format("MM/DD/YYYY, hh:mm a"));
				},
				autoOpen: false,
				height: 600,
				width: 600,
				title: 'Lead Scheduler',
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
						var job_id = $("#job_id").html();
					
						var googleInsert = {};
						googleInsert['calendarID'] = calendarName;
						googleInsert['summary'] = summary;
						googleInsert['location'] = location;
						googleInsert['start'] = start;
						googleInsert['end'] = end;
						googleInsert['description'] = description;
						googleInsert['job_id'] = job_id;
						
						$.ajax({
							type: "POST",
							url: '/customers/postGoogleInsert',
							data: googleInsert,
							success: function(data) {
								document.location.href='/customers';
							}
						});
						//This will close the popup div form
						$( this ).dialog( "close" );
					},
					"Cancel": function() {
						$( this ).dialog( "close" );
					},
					"Edit Lead": function() {
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
		allDayText: 'All Day',
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
        },

        eventMouseout: function(calEvent, domEvent) {
			if(!$("#events-layer").hasClass('mouse_in')){
				$("#events-layer").remove();
			}
        },
		
			windowResize: function(view) {
			},

			eventSources: [
			{
				url: '/events/getCalEvents/x/x/all',
				type: 'GET',
				success: function(events) {
					$(events).each(function() {
						if(this.cal_user_id == 1) {
							this['textColor'] = 'grey';
							this['backgroundColor'] = 'yellow';
							this['borderColor'] = 'grey';
						} else if(this.cal_user_id == 2) {
							this['textColor'] = 'white';
							this['backgroundColor'] = 'blue';
							this['borderColor'] = 'grey';
						} else if(this.cal_user_id == 3) {
							this['textColor'] = 'white';
							this['backgroundColor'] = 'green';
							this['borderColor'] = 'grey';
						}
					});
					console.log("events (calendar) =", events);
					mapPaint(events);
				},
				error: function() {
					alert('there was an error while fetching events!');
				},
			},
		]
	});
/*  Full Calendar - End */

	$('.fc-header > tbody:last').append('<tr id="map_tr" class="collapse"></tr>');
		$('#map_tr').append('<td id="map_td" class="mapContainer" colspan="3"></td>');
			$('#map_td').append('<div id="maps_block"></div>');
				$('#maps_block').append('<span class="maps map1" id="map_1"></span>');
				$('#maps_block').append('<span class="maps map2" id="map_2"></span>');
				$('#maps_block').append('<span class="maps map3" id="map_3"></span>');
				$('#maps_block').append('<span class="maps map4" id="map_4"></span>');
				$('#maps_block').append('<span class="maps map5" id="map_5"></span>');

	$('#map_day').hide();

	$( "#salescheckbox1" ).click(function() {
		var id = $( "#salescheckbox1" ).val();
		var value = null;
		if($("#salescheckbox1").is(':checked')) {
			value = 1;
		} else {
			value = 0;
		}
		$.post( "/profiles/postSalesCheckBox", { id: id, value: value });
		$('#calendar').fullCalendar('refetchEvents');
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
		$('#calendar').fullCalendar('refetchEvents');
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
		$('#calendar').fullCalendar('refetchEvents');
	});
	
	$( "#reset_page" ).click(function() {
		    location.reload();
	});
	
	$( ".fc-button-agendaDay" ).click(function() {
		$('#maps_block').collapse('hide');
		$('.fc-header').width('1130px');
		$('.fc-header').css( "max-width", "1130px" )		
		$("#map_day_container").css('display', 'block');
		$('#map_day').show();
		$("#calendar" ).css( "width", "49%" );
		$('#calendar').fullCalendar('option', 'aspectRatio', .8);
		$('#calendar').fullCalendar('render');
		mapPaint(eventsList);
	});

	$( ".fc-button-agendaWeek" ).click(function() {
		$('#map_day').hide();
		$("#calendar" ).css( "width", "100%" );		
		$('#calendar').fullCalendar('render');
		$('#maps_block').collapse('show');
	});

	$( ".fc-button-month" ).click(function() {
		$('#maps_block').collapse('hide');
		$("#calendar" ).css( "width", "100%" );
		$('#calendar').fullCalendar('render');
		$('#map_day').hide();
	});

	$( "#rerender" ).click(function() {
		removeMarkers();
	});
	
	$( "#calendar" ).load(function() {
		$('#calendar').fullCalendar('render');
	});
	
	$( ".fc-button-next, .fc-button-prev, .fc-button-today" ).click(function() {
		if ($(".fc-button-agendaDay").hasClass("fc-state-active")) {
			//$('#calendar').fullCalendar('refetchEvents');
			//alert("refetched");
		}
	});
	
	function mapPaint(events) {
		console.log("mapPaint-events", events);
		var map1 = [], map2 = [], map3 = [], map4 = [], map5 = [], map_day  = [];
		var start = Date.parse($('#calendar').fullCalendar('getView').visStart)/1000;
		var day2Start = start+86400;
		var day3Start = day2Start+86400;
		var day4Start = day3Start+86400;
		var day5Start = day4Start+86400;
		
		var mapOptions = {};
		function initialize() {	
			mapOptions = {
				center: new google.maps.LatLng(34.052234, -118.243685),
				zoom: 8,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
			};
		};
		
		google.maps.event.addDomListener(window, 'load', initialize);
		
		if ( $(".fc-button-agendaWeek").hasClass("fc-state-active")) {
			$(events).each(function(index) {
				if (( this.start >= start && this.start <= start+86399) || (this.end >= start && this.end <= start+86399)) {
					map1.push(this);
				} else if (( this.start >= day2Start && this.start <= day2Start+86399) || (this.end >= day2Start && this.end <= day2Start+86399)) {
					map2.push(this);
				} else if (( this.start >= day3Start && this.start <= day3Start+86399) || (this.end >= day3Start && this.end <= day3Start+86399)) {
					map3.push(this);
				} else if (( this.start >= day4Start && this.start <= day4Start+86399) || (this.end >= day4Start && this.end <= day4Start+86399)) {
					map4.push(this);
				} else if (( this.start >= day5Start && this.start <= day5Start+86399) || (this.end >= day5Start && this.end <= day5Start+86399)) {
					map5.push(this);
				}
			});
			
			initMap1(map1, mapOptions);
			initMap2(map2, mapOptions);
			initMap3(map3, mapOptions);
			initMap4(map4, mapOptions);
			initMap5(map5, mapOptions);
			
			eventsList = events;
			console.log("eventsList = ", eventsList);
		} else if ( $(".fc-button-agendaDay").hasClass("fc-state-active")) {
			$(events).each(function(index) {
				if($.isNumeric(this.start) == false) {
					this.start = Date.parse(this.start)/1000;
					this.end = Date.parse(this.end)/1000;
				}
				if (( this.start >= start && this.start <= start+86399) || (this.end >= start && this.end <= start+86399)) {
					map_day.push(this);
				}
			});
			console.log("agendaDay - events = ", events);
			console.log("map_day = ", map_day);
			console.log("this.start = ", this.start);
			mapDay(map_day, mapOptions);
		}
		console.log("markersArray = ", markersArray);
	};
	

});

