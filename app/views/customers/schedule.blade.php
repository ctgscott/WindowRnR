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
<script type='text/javascript' src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/calendar.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/schedule.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery.validationEngine.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery.validationEngine-en.js') }}"></script>
@stop

{{-- Content --}}
@section('content')


<h4>Estimates Appointments</h4>

<?php 
	//echo "<pre>".var_dump(CustomersController::EstimateSchedule(26))."</pre>";
?>

	<div class="container-fluid">
		<div id="calendar"></div>
	</div>
<div>&nbsp;</div>

<DIV style="DISPLAY: none" id=schedulebox title="Schedule Appointment">
	<FORM id=scheduleformID method=post>
		<DIV class=sysdesc>&nbsp;</DIV>
		<DIV class="row" id="timeSelected">Time Selected for Lead id #<span id="job_id" name="job_id"><?php echo $lead['0']->job_id ?></span>&nbsp;</div> 
		<DIV class="row">
<!--			<div class="span2 field">
				<LABEL class="scheduleLabel">Arrival Window</LABEL> 
				<SELECT id=arrivalWindow name=arrivalWindow> 
					<OPTION selected value=.5>1/2 hour</OPTION>
					<OPTION value=1>1 hour</OPTION>
				</SELECT>
			</div>
-->			<div class="span2 calendar">
				<LABEL class="scheduleLabel">Calendar</LABEL> 
				<SELECT id=calendarName name=calendarName> 
					<OPTION selected value="windowrnr.com_c7df92ao3vvg02n2kh52b81tn4@group.calendar.google.com">Norm's</OPTION>
					<!--<OPTION value="Ed">Ed's</OPTION>-->
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
				<TEXTAREA id=location rows=1 cols=43 name=location disabled>{{ $lead[0]->job_address }}, {{ $lead[0]->job_city }}, {{ $lead[0]->job_zip }}</TEXTAREA>
			</div>
		</div>
		<DIV class=rowElem>
			<LABEL class="scheduleLabel">Notes:</LABEL>
			<TEXTAREA id=notes rows=4 cols=43 name=notes disabled>@foreach ($notes as $note)*{{ $note->note }} [{{ $note->user_name }}: {{ date("g:i a, m/d/Y", strtotime($note->created_at)) }}]{{ "\n" }}@endforeach</TEXTAREA>
		</DIV>
	</FORM>
</DIV>



@stop

@section('scripts')
@stop
