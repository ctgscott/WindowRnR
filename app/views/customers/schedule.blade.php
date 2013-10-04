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
	</div>
<div>&nbsp;</div>
<div class="well well-small">
<!--	<div id='wrap'>
		<div id='external-events'>
			<h4>Draggable Events</h4>
			<div class='external-event'>My Event 1</div>
			<div class='external-event'>My Event 2</div>
			<div class='external-event'>My Event 3</div>
			<div class='external-event'>My Event 4</div>
			<div class='external-event'>My Event 5</div>
			<p>
				<input type='checkbox' id='drop-remove' /> <label for='drop-remove'>remove after drop</label>
			</p>
		</div>
		<div id='calendar'></div>
		<div style='clear:both'></div>
	</div>
-->
	<?php $results['id'] = Sentry::getUser()->id;
		$results['first_name'] = Sentry::getUser()->first_name;
		$results['user'] = Sentry::findUserById($results['id'])->first_name;
		print_r($results);
	?>
	<h4><em>Existing leads</em></h4>
	<div class="row" id='wrap'>
		<p>
			<input type='checkbox' id='drop-remove' /> <label for='drop-remove'>remove after drop</label>
		</p>
		<div class="span12" id='external-events'>
			<div class="row">
				<div class="span1">#</div>
				<div class="span1">Created</div>
				<div class="span1">Last Name</div>
				<div class="span1">Address</div>
				<div class="span1">City</div>
				<div class="span1">Built&nbsp;</div>
				<div class="span2">Phone</div>
				<div class="span2">Email</div>
				<div class="span2">Action</div>
			</div>
			
			@foreach ($customers as $customer)
				<div class="row">
					<div class="external-event span1">{{ $customer->job_id }}</div>
					<div class="span1">{{ date("n/j/y", strtotime($customer->job_created_at)) }}</div>
					<div class="span1"><a href="/customers/{{ $customer->job_id }}">{{ $customer->customer_lname }}</a></div>
					<div class="span1">{{ $customer->job_address }}</div>
					<div class="span1">{{ $customer->job_city }}</div>
					<div class="span1">{{ $customer->job_house_built }}</div>
					<div class="span2">{{ $customer->customer_phone }}</div>
					<div class="span2">{{ $customer->customer_email }}</div>
					<div class="span2">
						<button class="btn-mini btn-danger" onClick="location.href='{{ URL::to('customers/archive') }}/{{ $customer->job_id}}'">Archive</button> 
						<button class="btn-mini btn-success action_confirm radius" onClick="location.href='{{ URL::to('customers/schedule') }}/{{ $customer->job_id}}'">Schedule</button>
					</div>
				</div>
			@endforeach
		</div>
		<div id='calendar'></div>
		<div style='clear:both'></div>
	</div>
</div>

<!--	<table class="table table-condensed table-striped">
		<thead>
			<th>#&nbsp;&nbsp;</th>
			<th>Created</th>
			<th>Last Name</th>
			<th>Address</th>
			<th>City</th>
			<th>Built&nbsp;</th>
			<th>Phone</th>
			<th>email</th>
		</thead>
		<tbody>
			@foreach ($customers as $customer)
				<tr>
					<td>{{ $customer->job_id }}</td>
					<td>{{ date("n/j/y", strtotime($customer->job_created_at)) }}</td>
					<td><a href="/customers/{{ $customer->job_id }}">{{ $customer->customer_lname }}</a></td>
					<td>{{ $customer->job_address }}</a></td>
					<td>{{ $customer->job_city }}</td>
					<td>{{ $customer->job_house_built }}</td>
					<td>{{ $customer->customer_phone }}</td>
					<td>{{ $customer->customer_email }}</td>
					<td>
						<button class="btn-mini btn-danger" onClick="location.href='{{ URL::to('customers/archive') }}/{{ $customer->job_id}}'">Archive</button> 
						<button class="btn-mini btn-success action_confirm radius" onClick="location.href='{{ URL::to('customers/schedule') }}/{{ $customer->job_id}}'">Schedule</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
-->	
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
/*	require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
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
*/	
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
