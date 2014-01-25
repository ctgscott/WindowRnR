var cal1 = [];
var cal2 = [];
var cal3 = [];
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
								alert(data)
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
				alert('The calendar has adjusted to a window resize');
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
					console.log("events ="+events);
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
//	$('#map_td').append('<span class="maps map1" id="map_1"></span><span class="maps" id="map_2">2</span><span class="maps" id="map_3">3</span><span class="maps" id="map_4">4</span><span class="maps" id="map_5">5</span>');
			$('#map_td').append('<div id="maps_block"></div>');
				$('#maps_block').append('<span class="maps map1" id="map_1"></span>');
				$('#maps_block').append('<span class="maps map2" id="map_2"></span>');
				$('#maps_block').append('<span class="maps map3" id="map_3"></span>');
				$('#maps_block').append('<span class="maps map4" id="map_4"></span>');
				$('#maps_block').append('<span class="maps map5" id="map_5"></span>');

	$('#map_day').hide();

/*	$('#map_1').gmap().bind('init', function() { 
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
*/
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
//		$('#map_container').collapse('hide');
//		$('#maps_block').hide();
		$('#maps_block').collapse('hide');
		$('.fc-header').width('1130px');
		$('.fc-header').css( "max-width", "1130px" )		
		$("#map_day_container").css('display', 'block');
		$('#map_day').show();
		$("#calendar" ).css( "width", "49%" );
		$('#calendar').fullCalendar('option', 'aspectRatio', .8);
		$('#calendar').fullCalendar('render');

		var map_day = L.map('map_day', {
			trackResize: true,
			zoomControl: true,
		}).setView([37.8, -96], 4);
		
		L.tileLayer('http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png', {
//			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
//			maxZoom: 18
		}).addTo(map_day);
		
		var markers = jQuery.parseJSON($('#events1').val());
		var bounds = new Array();
		
		$.each( markers, function(n, marker) {
			var myIcon = L.icon({
				iconUrl: "/img/"+marker.avatar
			})
			L.marker([marker.lat, marker.lng], {
				title: marker.title,
				icon: myIcon
			}).addTo(map_day);
			var newLatLng = new L.LatLng(marker.lat, marker.lng);
			bounds.push(newLatLng);
		});
		
		map_day.fitBounds(bounds);
		
/*		$('#map_day').gmap().bind('init', function() { 
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
*/	});

	$( ".fc-button-agendaWeek" ).click(function() {
//		$('#map_container').collapse('show');
		$('#map_day').hide();
		$("#calendar" ).css( "width", "100%" );		
		$('#calendar').fullCalendar('render');
		$('#maps_block').collapse('show');
//		$("#map_day_container").collapse('hide');
	});

	$( ".fc-button-month" ).click(function() {
//		$('#map_container').hide();
//		$('#map_tr').hide();
		$('#maps_block').collapse('hide');
		$("#calendar" ).css( "width", "100%" );
		$('#calendar').fullCalendar('render');
		$('#map_day').hide();
//		$("#map_day_container").collapse('hide');
	});

	$( "#rerender" ).click(function() {
		$('#calendar').fullCalendar('render');
	});
	
	$( "#calendar" ).load(function() {
		$('#calendar').fullCalendar('render');
	});
	
	$(".fc-button-agendaDay, .fc-button-agendaWeek, .fc-button-month, fc-button-today, fc-button-next, fc-button-prev").click(function() {
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
	});
	
	function mapPaint(events, start) {
		var map1 = [], map2 = [], map3 = [], map4 = [], map5 = [], map_day  = [];
		var start = $('#calendar').fullCalendar('getView').visStart;
//		alert("start = "+start);
		if ( $(".fc-button-agendaWeek").hasClass("fc-state-active")) {
			$(events).each(function(index) {
				if ( this.start >= start && this.end <= start+86399) {
					map1.push(this);
				} else if ( this.cal_user_id == 2) {
					map2.push(this);
				} else if ( this.cal_user_id == 3) {
					map3.push(this);
				}
			});
			console.log("map1 = "+map1);
			mapOne(map1);
		} else if ( $(".fc-button-agendaDay").hasClass("fc-state-active")) {
			alert('hello day');
		}
//		var view = $('#calendar').fullCalendar('getView');
//		alert("The view's title is " + view.title);
	};
	

});

