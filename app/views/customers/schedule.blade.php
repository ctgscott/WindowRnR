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
	<div class="container-fluid">
		<div id="calendar"></div>
		<button class="test btn btn-primary">TEST</button>
	<!--	{//{ Calendar::getEvents(date('c')) }}-->
		<?php echo json_encode(CustomersController::EstimateSchedule2()) ?>
	<!--	{//{ CustomersController::EstimateSchedule() }}-->
		<a href="#" rel="drevil">mischief</a>
	</div>

<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn" data-toggle="modal" data-target="#myModal">Launch demo modal</a>
<div id="popoverTemplateContainer" style="display: none">

    <div id="popoverTemplate">
        <div class="popover" >
                //Custom data here
        </div>
    </div>
</div> 
<div></div>

<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
	ob_start();
	$firephp = FirePHP::getInstance(true);
	$firephp->log($_SESSION, 'Schedule.Blade');
	if(isset($_SESSION['lead']))
		$firephp->log($_SESSION, 'Iterators');
		
	//echo $_SESSION;		
	//echo $_SESSION['_sf2_attributes']['_token'];
	//echo $results['lead'];
	echo '<pre>';
	var_dump($lead);
	echo '</pre>';
	echo '<pre>';
	var_dump($notes);
	echo '</pre>';
		
	echo '<pre>';
	print_r($lead[0]->job_city);
	echo '</pre>';
	
	foreach ($notes as $note) {
		echo '<pre>';
		print_r($note);
		echo '</pre>';
	}
?>
<!--<iframe src="https://www.google.com/calendar/embed?title=NormTest&amp;mode=WEEK&amp;height=600&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=windowrnr.com_c7df92ao3vvg02n2kh52b81tn4%40group.calendar.google.com&amp;color=%23182C57&amp;ctz=America%2FLos_Angeles" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>-->

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
    <p>One fine body…</p>
    <p>One fine body…</p>
    <p>One fine body…</p>
    <p>One fine body…</p>
    <p>One fine body…</p>
    <p>One fine body…</p>
    <p>One fine body…</p>
    <p>One fine body…</p>
    <p>One fine body…</p>
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" >Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>

<DIV style="DISPLAY: none" id=reservebox title="Reserve meeting room">
	<FORM id=reserveformID method=post>
		<DIV class=sysdesc>&nbsp;</DIV>
		<DIV class=rowElem>
			<LABEL>meeting room:</LABEL> 
			<SELECT id=meeting class=validate[required] name=meeting></SELECT>
		</DIV>
		<DIV class=rowElem><LABEL>Repeated weeks:</LABEL> 
			<SELECT id=repweeks name=repweeks> 
				<OPTION selected value=0>Not repeated</OPTION>
				<OPTION value=2>1 week</OPTION>
				<OPTION value=3>2 weeks</OPTION>
				<OPTION value=4>3 weeks</OPTION>
				<OPTION value=5>4 weeks</OPTION>
				<OPTION value=9>8 weeks</OPTION>
				<OPTION value=17>16 weeks</OPTION>
				<OPTION value=33>32 weeks</OPTION>
			</SELECT>
		</DIV>
		<DIV class=rowElem>
			<LABEL>start time:</LABEL>
			<INPUT id=start class=validate[required,funcCall[validate2time]] name=start>
		</DIV>
		<DIV class=rowElem>
			<LABEL>end time:</LABEL>
			<INPUT id=end class=validate[required,funcCall[validate2time]] name=end>
		</DIV>
		<DIV class=rowElem>
			<LABEL>Title:</LABEL>
			<INPUT id=title name=title>
		</DIV>
		<DIV class=rowElem>
			<LABEL>Details:</LABEL>
			<TEXTAREA id=details rows=3 cols=43 name=details></TEXTAREA>
		</DIV>
		<DIV class=rowElem> </DIV>
		<DIV class=rowElem> </DIV>
		<DIV id=addhelper class=ui-widget>
			<DIV style="PADDING-BOTTOM: 5px; PADDING-LEFT: 5px; PADDING-RIGHT: 5px; PADDING-TOP: 5px" class="ui-state-error ui-corner-all">
				<DIV id=addresult></DIV>
			</DIV>
		</DIV>
	</FORM>
</DIV>
<DIV style="DISPLAY: none" id=schedulebox title="Schedule Appointment">
	<FORM id=scheduleformID method=post>
		<DIV class=sysdesc>&nbsp;</DIV>
		<DIV class="row" id=timeSelected>Time Selected:&nbsp;</div> 
		<DIV class="row">
			<div class="span2 field">
				<LABEL class="scheduleLabel">Arrival Window</LABEL> 
				<SELECT id=arrivalWindow name=arrivalWindow> 
					<OPTION selected value=0>1/2 hour</OPTION>
					<OPTION value=2>1 hour</OPTION>
				</SELECT>
			</div>
			<div class="span2 calendar">
				<LABEL class="scheduleLabel">Calendar</LABEL> 
				<SELECT id=calendarName name=calendarName> 
					<OPTION selected value=0>Norm's</OPTION>
					<OPTION value=2>Ed's</OPTION>
					<OPTION value=3>Scott's</OPTION>
				</SELECT>
			</div>
		</DIV>
		<div class="row">
			<div class="span4 field">
				<LABEL class="scheduleLabel">Title:</LABEL>
				<TEXTAREA id=title rows=1 cols=43 name=title disabled>({{ $lead[0]->job_city }})&nbsp;{{ $lead[0]->customer_lname }}</TEXTAREA>
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
