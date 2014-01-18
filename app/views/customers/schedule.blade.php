@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
Schedule Appointments
@stop

@section('styles')
<link rel='stylesheet' type='text/css' href="{{ asset('css/fullcalendar.css') }}" />
<link rel='stylesheet' type='text/css' href="{{ asset('css/leaflet.css') }}" />
<link rel='stylesheet' type='text/css' href="{{ asset('css/jquery-ui-1.10.3.custom.min.css') }}" />
<link rel='stylesheet' type='text/css' href="{{ asset('css/validationEngine.jquery.css') }}" />
<link rel='stylesheet' type='text/css' href="{{ asset('css/customer.css') }}" >
<link rel='stylesheet' type='text/css' href="{{ asset('css/schedule.css') }}" >
<link rel='stylesheet' type='text/css' href="{{ asset('css/cool-buttons.css') }}" >
<!--<script type='text/javascript' src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>-->
<script type='text/javascript' src="{{ asset('js/jquery-2.0.3.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/leaflet.js') }}"></script>
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
	<button id="reset_page" class="goog-buttonset-action cool-button" onclick="" tabindex="1" type="submit">Refresh Page</button>
	<button id="rerender" class="goog-buttonset-action cool-button" onclick="" tabindex="2" type="submit">Rerender Events</button>
</div>

<div id="map_container" class="container-fluid mapContainer">
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
	<input type="hidden" id="cal1" value='{{ (isset($cal1) ? json_encode($cal1) : "none") }}'/>
	<input type="hidden" id="cal2" value='{{ (isset($cal2) ? json_encode($cal2) : "none") }}'/>
	<input type="hidden" id="cal3" value='{{ (isset($cal3) ? json_encode($cal3) : "none") }}'/>
</div>
<div class="container-fluid">
	<div id="calendar">
	</div>
	<div id="map_day_container" class="container-fluid mapDayContainer">
		<span class="map_day" id="map_day">x</span>
	</div>
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
