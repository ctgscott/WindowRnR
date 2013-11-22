@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
Log In
@stop

@section('styles')
<link href="{{ asset('css/customer.css') }}" rel="stylesheet">
<script type='text/javascript' src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/fieldAdd.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/moment.min.js') }}"></script>
@stop

{{-- Content --}}
@section('content')
<div class="well well-small">
	<!--{//{ Form::open(array('action' => 'CustomersController@newLead', 'class' => 'form-inline', 'id' => 'newLeadForm')) }}-->
	<form id="newLeadForm" class="form-inline" action="/customers/newLead" method="POST">
	<div>
		<h4><em>Customer Information:</em></h4>
		<input placeholder="Last Name" id="l_name" class="input-small" name="l_name" type="text" value="" autocomplete="off" required>
		<input placeholder="First Name" id="f_name" class="input-small" name="f_name" type="text" value="" required>
		<?php echo Form::text('phone', '', array('placeholder' => 'Phone', 'class' => 'input-small', 'id' => 'phone')); ?>
		<?php echo Form::text('alt_phone', '', array('placeholder' => 'Alt. Phone', 'class' => 'input-small', 'id' => 'phone2')); ?>
		<?php echo Form::text('email', '', array('placeholder' => 'email', 'class' => 'input-small', 'id' => 'email')); ?>
	</div>
	<div id="jobList" class="accordion-body collapse" >
		<h4><em>Prior Jobs</em></h4>
		<table class="table table-condensed table-striped">
			<thead>
				<th>&nbsp;&nbsp;</th>
				<th>Job ID</th>
				<th>Address</th>
				<th>City</th>
				<th>Est. Scheduled</th>
				<th>Job Scheduled</th>
				<th>Job Completed</th>
			</thead>
			<tbody id="jobs_table">
			</tbody>
		</table>
		<button class="btn-small btn" onClick="copyButton()" id="copyButton">Copy info to new job</button>
	</div>
	<hr>
	<h4><em>Job & Jobsite Information:</em></h4>
	<div class="row-fluid">
		<div class="span12">
			<input placeholder="Jobsite Address" id="job_address" class="input-small address" name="address" type="text" value="" required>
			<?php echo Form::text('city', '', array('placeholder' => 'City', 'id' => 'job_city', 'class' => 'input-small city')); ?>
			<input placeholder="Zip" class="input-small zip" name="zip" type="text" id="zip" value="">
			<?php echo Form::text('built', '', array('placeholder' => 'Year Built', 'class' => 'input-small built', 'id' => 'built')); ?>
		</div>
		<div class="row">
			<div class="span6 well well-small" name="checkbox">
				<div id="window_type" class="style">Window Material(s) & Style(s)
					<a id="btnAdd" class="btnAdd">Add'l Group <i class="icon-plus" id="add"></i></a>
				</div>
				<div id="parent">
					<div id="style_group_1" class="clonedSection">
						<input placeholder="Qty: (#)" id="window_qty" class="input-mini" type="text" name="qty1" value="">
						<select class="materialSelect" name="material1">
							<option selected="selected">Material</option>
							<option>Wood</option>
							<option>Steel</option>
							<option>Aluminum</option>
							<option>Vinyl</option>
						</select>
						<select class="styleSelect" name="style1">
							<option selected="selected">Style</option>
							<option>Double Hung</option>
							<option>Casement</option>
							<option>Slider</option>
							<option>Awning</option>
							<option>Hopper</option>
							<option>Transom</option>
							<option>Picture</option>
							<option>Other</option>
						</select>
						<!--<a id="btnDel1" class="btnAdd btnDel"><i id="close1" class="icon-remove"></i>Delete row</a>-->
					</div>
				</div>
			</div>
			<div class="span6 well well-small" name="source">
				<div class="sourceTitle">
					<em>Lead Source:</em>
				</div>
				<div id="lead_source">
					<input type="checkbox" id="sourceCheckbox1" value="Angies" name="lead_source[]"> Angies&nbsp;&nbsp;
					<input type="checkbox" id="sourceCheckbox2" value="Yelp" name="lead_source[]"> Yelp&nbsp;&nbsp;
					<input type="checkbox" id="sourceCheckbox3" value="Google" name="lead_source[]"> Google&nbsp;&nbsp;
					<input type="checkbox" id="sourceCheckbox4" value="LA Conservancy" name="lead_source[]"> LA Conserv.&nbsp;&nbsp;
				</div>
				<div>
					<input type="checkbox" id="sourceCheckbox5" value="Other" name="lead_source[]"> Referral or Other:
					<?php echo Form::text('source_referral', '', array('placeholder' => 'Note Referral or Other', 'class' => 'input-large', 'name' => 'source_referral', 'id' => 'source_referral', 'disabled' => 'disabled')); ?>
				</div>
				</div>
			</div>
		</div>
		<div>
			<textarea placeholder="Notes" id="note" value="" class="textarea" rows="6" name="note"></textarea>
		</div>
	</div>
	<div>
		<?php echo Form::submit('Save', ['class' => 'btn btn-small btn-primary', 'name' => 'saveNewLead', 'id' => 'saveNewLead']);?>
		<?php echo Form::submit('Schedule Appt.', ['class' => 'btn btn-small btn-success', 'name' => 'scheduleNewLead', 'id' => 'scheduleNewLead']);?>
		<?php echo Form::close(); ?>
	</div>
</div>

<div class="well well-small">
	<h4><em>Existing leads</em></h4>
	<table class="table table-condensed table-striped">
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
		<tbody class="existing">
			@foreach ($customers as $customer)
				<tr>
					<td>{{ $customer->job_id }}</td>
					<td>{{ date("n/j/y", strtotime($customer->job_created_at)) }}</td>
					<td class="cust_name"><a href="/customers/{{ $customer->job_id }}">{{ $customer->customer_lname }}</a></td>
					<td>{{ $customer->job_address }}</a></td>
					<td>{{ $customer->job_city }}</td>
					<td>{{ $customer->job_house_built }}</td>
					<td>{{ $customer->customer_phone }}</td>
					<td>{{ $customer->customer_email }}</td>
					<td>
						<button class="btn-mini btn-danger" onClick="location.href='{{ URL::to('customers/archive') }}/{{ $customer->job_id}}'">Archive</button> 
						<button id="scheduleBtn" class="btn-mini btn-success action_confirm radius" onClick="location.href='{{ URL::to('customers/schedule') }}/{{ $customer->job_id}}'">Schedule</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop

@section('scripts')
	<script type='text/javascript' src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script type='text/javascript' src="{{ asset('js/typeahead.min.js') }}"></script> 
<!--	<script type='text/javascript' src="{{ asset('js/bootstrap3-typeahead.js') }}"></script>-->
	<script type='text/javascript' src="{{ asset('js/jquery.maskedinput.js') }}"></script>
	<script type='text/javascript' src="{{ asset('js/maskedinput.js') }}"></script>
	<script type='text/javascript' src="{{ asset('js/customer.js') }}"></script>
@stop
