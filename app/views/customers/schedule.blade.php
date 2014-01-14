@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
Schedule Appointments
@stop

@section('styles')
<link rel='stylesheet' type='text/css' href="{{ asset('css/fullcalendar.css') }}" />
<link rel='stylesheet' type='text/css' href="{{ asset('css/jquery-ui-1.10.3.custom.min.css') }}" />
<link rel='stylesheet' type='text/css' href="{{ asset('css/validationEngine.jquery.css') }}" />
<link rel='stylesheet' type='text/css' href="{{ asset('css/customer.css') }}" >
<link rel='stylesheet' type='text/css' href="{{ asset('css/schedule.css') }}" >
<!--<script type='text/javascript' src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>-->
<script type='text/javascript' src="{{ asset('js/jquery-2.0.3.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/calendar.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/schedule.js') }}"></script>
<!--<script type='text/javascript' src="{{ asset('js/jquery.validationEngine.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery.validationEngine-en.js') }}"></script>-->
<script type='text/javascript' src="{{ asset('js/moment.min.js') }}"></script>
<script type='text/javascript' src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
<script type='text/javascript' src="{{ asset('js/gomap-1.3.2.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery.ui.map.full.min.js') }}"></script>
@stop

{{-- Content --}}
@section('content')
<h4>Estimates Appointments</h4>
<div class="avatarList">
	@foreach ($profiles as $seller)
		<img src="{{ '/img/'.$seller['avatar'] }}" />
		<input type="checkbox" id="salescheckbox{{ $seller['id'] }}" value="{{ $seller['id'] }}" name="salesTeam[]" @if ($seller['sales'] == '1') checked @endif > {{ $seller['first_name'] }}
	@endforeach
</div>

<div class="container-fluid mapContainer">
	<span class="maps map1" id="map_1"></span>
	<span class="maps" id="map_2">2</span>
	<span class="maps" id="map_3">3</span>
	<span class="maps" id="map_4">4</span>
	<span class="maps" id="map_5">5</span>
	<input type="hidden" id="profiles" value='{{ json_encode($profiles) }}'/>
	<input type="hidden" id="events1" value='{{ json_encode($map1) }}'/>
	<input type="hidden" id="events2" value='{{ json_encode($map2) }}'/>
	<input type="hidden" id="events3" value='{{ json_encode($map3) }}'/>
	<input type="hidden" id="events4" value='{{ json_encode($map4) }}'/>
	<input type="hidden" id="events5" value='{{ json_encode($map5) }}'/> 
	<input type="hidden" id="cal1" value='{{ json_encode($cal1) }}'/>
	<input type="hidden" id="cal2" value='{{ json_encode($cal2) }}'/>
	<input type="hidden" id="cal3" value='{{ json_encode($cal3) }}'/>
	<?php
/*		use Ivory\GoogleMap\Map;
		use Ivory\GoogleMap\Helper\MapHelper;
		use Ivory\GoogleMap\Overlays\Animation;
		use Ivory\GoogleMap\Overlays\Marker;
		use Ivory\GoogleMap\Overlays\InfoWindow;
		use Ivory\GoogleMap\Events\MouseEvent;

		$map = new Map();
		
		//$trafficLayer = new TrafficLayer();
		//$trafficLayer.setMap(map);

		$map->setAutoZoom(true);
		$map->setStylesheetOptions(array(
			'width'  => '100%',
			'height' => '300px',
			'border-radius' => '8px',
			'-webkit-box-shadow' => '0 5px 10px rgba(0,0,0,.2)',
			'-moz-box-shadow' => '0 5px 10px rgba(0,0,0,.2)',
			'box-shadow' => '0 5px 10px rgba(0,0,0,.2)',
		));
		//$map->setCenter(34.03004,-118.304986, true);
		//$map->setMapOption('zoom', 8);
		
		$marker = new Marker();
		$marker->setPrefixJavascriptVariable('marker_');
		$marker->setPosition(34.03004,-118.304986, true);
		$marker->setAnimation(Animation::DROP);
		$marker->setAnimation('drop');
		$marker->setOptions(array(
			'clickable' => true,
			'flat'      => true,
		));
		$infoWindow = new InfoWindow();
		$infoWindow->setPrefixJavascriptVariable('info_window_');
		$infoWindow->setPosition(34.03004,-118.304986, true);
		$infoWindow->setPixelOffset(1.1, 2.1, 'px', 'pt');
		$infoWindow->setContent('<p>Customer #1</p>');
		$infoWindow->setOpen(false);
		$infoWindow->setAutoOpen(true);
		$infoWindow->setOpenEvent(MouseEvent::CLICK);
		$infoWindow->setAutoClose(true);
		$infoWindow->setOptions(array(
			'disableAutoPan' => true,
			'zIndex'         => 10,
		));
		$marker->setInfoWindow($infoWindow);
		
		$marker2 = new Marker();
		$marker2->setPrefixJavascriptVariable('marker_');
		$marker2->setPosition(33.822684,-118.111446, true);
		$marker2->setAnimation(Animation::DROP);
		$marker2->setAnimation('drop');
		$marker2->setOptions(array(
			'clickable' => true,
			'flat'      => true,
		));
		$infoWindow2 = new InfoWindow();
		$infoWindow2->setPrefixJavascriptVariable('info_window_');
		$infoWindow2->setPosition(33.822684,-118.111446, true);
		$infoWindow2->setPixelOffset(1.1, 2.1, 'px', 'pt');
		$infoWindow2->setContent('<p>Customer #2</p>');
		$infoWindow2->setOpen(false);
		$infoWindow2->setAutoOpen(true);
		$infoWindow2->setOpenEvent(MouseEvent::CLICK);
		$infoWindow2->setAutoClose(true);
		$infoWindow2->setOptions(array(
			'disableAutoPan' => true,
			'zIndex'         => 10,
		));
		$marker2->setInfoWindow($infoWindow2);
		
		$map->addMarker($marker);
		$map->addMarker($marker2);
		
		$mapHelper = new MapHelper();

		echo $mapHelper->render($map);
*/	?>					
</div>
<div class="container-fluid">
	<div id="calendar"></div>
</div>


<DIV style="DISPLAY: none" id=schedulebox title="Schedule Appointment">
	<FORM id=scheduleformID method=post>
		<DIV class=sysdesc>&nbsp;</DIV>
		<DIV class="row" id="timeSelected">Time Selected for Lead id #<span id="job_id" name="job_id"><?php echo $lead['0']->job_id ?></span>&nbsp;</div> 
		<DIV class="row">Starting:&nbsp;<span id="startTime"></span></div>
		<DIV class="row">Ending:&nbsp;<span id="endTime"></span><br/><br/></div>
		<DIV class="row">
			<div class="span2 calendar">
				<LABEL class="scheduleLabel">Calendar</LABEL> 
				<SELECT id=calendarName name=calendarName> 
					<OPTION selected value="windowrnr.com_c7df92ao3vvg02n2kh52b81tn4@group.calendar.google.com">Norm's</OPTION>
					<OPTION value="primary">Scott's</OPTION>
				</SELECT>
			</div>
		</DIV>
		<div class="row">
			<div class="span4 field">
				<LABEL class="scheduleLabel">Summary:</LABEL>
				<TEXTAREA id=summary rows=1 cols=43 name=summary disabled>({{ $lead[0]->job_city }})&nbsp;{{ $lead[0]->customer_lname }}, {{ $lead[0]->customer_fname }}</TEXTAREA>
			</div>
		</div>
		<div class="row">
			<div class="span4 field">
				<LABEL class="scheduleLabel">Location:</LABEL>
				<TEXTAREA id="location" rows=1 cols=43 name="location" disabled>{{ $lead[0]->job_address }}, {{ $lead[0]->job_city }}, {{ $lead[0]->job_zip }}</TEXTAREA>
			</div>
		</div>
		<DIV class="rowElem"><br/><br/>
			<LABEL class="scheduleLabel">Notes:</LABEL>
			<TEXTAREA id="notes" rows=4 cols=43 name="notes" disabled>@foreach ($notes as $note)*{{ $note->note }} [{{ $note->user_name }}: {{ date("g:i a, m/d/Y", strtotime($note->created_at)) }}]{{ "\n" }}@endforeach</TEXTAREA>
		</DIV>
	</FORM>
</DIV>



@stop

@section('scripts')
@stop
