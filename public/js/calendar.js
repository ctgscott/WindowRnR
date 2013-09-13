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
			if (allDay) {
				alert('Clicked on the map');
			}else{
				//alert('Clicked on the slot: ' + date);

				//$(this).css('background-color', 'red');

				var selectdate = $.fullCalendar.formatDate(date, "yyyy-MM-dd");
				var selecttime = $.fullCalendar.formatDate(date, "hh:mm tt");
							
				$('#schedulebox').dialog({
					autoOpen: false,
					height: 550,
					width: 600,
					title: 'Reserve meeting room on ' + selectdate + ' @ ' + selecttime,
//					title: 'Reserve meeting room on ' + date,
					modal: true,
					position: "center",
					draggable: false,
/*					beforeClose: function(event, ui) {
							$.validationEngine.closePrompt("#meeting");
							$.validationEngine.closePrompt("#start");
							$.validationEngine.closePrompt("#end");								
					},
*/					buttons: {
						"close": function() {
							$( this ).dialog( "close" );
						},
						"reserve": function() {				
//							if($("#reserveformID").validationEngine({returnIsValid:true})){
								var startdatestr = $("#start").val();
								var enddatestr = $("#end").val();		
								var confid = $("#meeting").val();	
								var repweeks = $("#repweeks").val();	
								if(repweeks==null){
									repweeks=0;
								}
								var startdate =  $.fullCalendar.parseDate(selectdate+"T"+startdatestr); 
								var enddate =  $.fullCalendar.parseDate(selectdate+"T"+enddatestr);
								var schdata = {startdate:startdate, enddate:enddate, confid:confid, repweeks:repweeks};									
								
								alert('Stuff: ' + startdate + ', ' + enddate);
//							}	
						}
					}
				});
				
				$( "#schedulebox" ).dialog( "open" );
				return false;

		
		
/*				if($(this).data('popover') == null)
				{					
					$(this).tooltip({
						animation: true,
						placement: 'right',
						trigger: 'manual',
						title: 'My Dynamic PopOver',
						container:'body',
						content:'Add Schedule to: ' + date,
						html : true,
					//template: $('#popoverTemplate').clone().attr('id','').html()
					}).tooltip('show');
				}
*//*					$.ajax({
						type: HTTP_GET,
						url: "/myURL"

						success: function(data)
						{
							//Clean the popover previous content
							$('.popover.in .popover-inner').empty();    

							//Fill in content with new AJAX data
							$('.popover.in .popover-inner').html(data);

						}*/
//					});

//				});

				if($(this).data('popover') !== null)
				{
				//	$(this).popover('hide');
				}
			}

//			alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

//			alert('Current view: ' + view.name);
						
			// change the day's background color just for fun
			//$(this).css('background-color', 'red');
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
