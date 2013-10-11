@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
Edit Lead Details
@stop

@section('styles')
<link href="{{ asset('css/customer.css') }}" rel="stylesheet">
<script type='text/javascript' src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
@stop

{{-- Content --}}
@section('content')
<div class="well well-small">
<?php 
	//echo "<pre>".var_dump($leadDetail)."</pre>";
	echo "<pre>".var_dump($jobs)."</pre>";
?>
	
	{{ Form::open(array('action' => 'CustomersController@store', 'class' => 'form-inline')) }}		
	<div>
		<h4><em>Customer Information:</em></h4>
		<input class="input-small" type="text" name="custID" value="Cust. ID #{{ $leadDetail['0']->customer_id }}" disabled/>
		<input placeholder="Last Name" class="input-small" name="l_name" type="text" value="{{ $leadDetail['0']->customer_lname }}" required>
		<input placeholder="First Name" class="input-small" name="f_name" type="text" value="{{ $leadDetail['0']->customer_fname }}" required>
		<?php echo Form::text('phone', $leadDetail[0]->customer_phone, array('placeholder' => 'Phone', 'class' => 'input-small', 'id' => 'phone' )); ?>
		<?php echo Form::text('alt_phone', $leadDetail[0]->customer_altphone, array('placeholder' => 'Alt. Phone', 'class' => 'input-small', 'id' => 'phone2')); ?>
		<?php echo Form::text('email', $leadDetail[0]->customer_email, array('placeholder' => 'email', 'class' => 'input-small')); ?>
	</div>
	<div>
		<h5><em>Customer billing information:</em></h5>
		<input placeholder="Billing Address" class="input-small" type="text" name="billing_address" value="{{ $leadDetail['0']->billing_address }}" >
		<input placeholder="City" class="input-small" name="billing_city" type="text" value="{{ $leadDetail['0']->billing_city }}" >
		<input placeholder="State" class="input-small" name="state" type="text" value="{{ $leadDetail['0']->billing_state }}" >
		<input placeholder="State" class="input-small" name="billing_zip" type="text" value="{{ $leadDetail['0']->billing_zip }}" >
	</div>
	<hr>
	<h4><em>Job & Jobsite Information:</em></h4>
	<div class="row-fluid">
		<div class="span12">
			<input placeholder="Jobsite Address" class="input-small" name="address" type="text" value="{{ $jobs['0']->job_address }}" required>
			<?php echo Form::text('city', $jobs['0']->job_address, array('placeholder' => 'City', 'class' => 'input-small')); ?>
			<input placeholder="Zip" class="input-small" name="zip" type="text" id="zip" value="{{ $jobs['0']->job_zip }}">
			<?php echo Form::text('built', $jobs['0']->job_house_built, array('placeholder' => 'Year Built', 'class' => 'input-small', 'id' => 'built')); ?>
		</div>
		<div class="row">
			<div class="span6 well well-small" name="checkbox">
				<div id="checkbox_label">Window Type(s):</div>
				<div>
					<input type="checkbox" id="typeCheckbox1" value="Wood" name="type[]"> Wood&nbsp;&nbsp;
					<input type="checkbox" id="typeCheckbox2" value="Steel" name="type[]"> Steel&nbsp;&nbsp;
					<input type="checkbox" id="typeCheckbox3" value="Aluminum" name="type[]"> Aluminum&nbsp;&nbsp;
					<input type="checkbox" id="typeCheckbox4" value="Vinyl" name="type[]"> Vinyl&nbsp;&nbsp;
				</div>
				<div id="checkbox_middle">
					<input type="checkbox" id="typeCheckbox5" value="Double Hung" name="type[]"> Double Hung&nbsp;&nbsp;
					<input type="checkbox" id="typeCheckbox7" value="Casement" name="type[]"> Casement&nbsp;&nbsp;
					<input type="checkbox" id="typeCheckbox8" value="Slider" name="type[]"> Slider&nbsp;&nbsp;
					<input type="checkbox" id="typeCheckbox9" value="Awning" name="type[]"> Awning&nbsp;&nbsp;
				</div>
				<div>
					<input type="checkbox" id="typeCheckbox6" value="" name="type[]"> Other:
					<?php echo Form::text('type_other', '', array('placeholder' => 'Note if "Other"', 'class' => 'input-large', 'name' => 'type_other', 'id' => 'type_other', 'disabled' => 'disabled')); ?>
				</div>
			</div>
			<div class="span6 well well-small" name="source">
				<em>Source:&nbsp;&nbsp;</em>
				<div id="source">
					<input type="checkbox" id="sourceCheckbox1" value="Angies" name="type[]"> Angies&nbsp;&nbsp;
					<input type="checkbox" id="sourceCheckbox2" value="Yelp" name="type[]"> Yelp&nbsp;&nbsp;
					<input type="checkbox" id="sourceCheckbox3" value="Google" name="type[]"> Google&nbsp;&nbsp;
					<input type="checkbox" id="sourceCheckbox4" value="LA Conservancy" name="type[]"> LA Conserv.&nbsp;&nbsp;
				</div>
				<div>
					<input type="checkbox" id="sourceCheckbox5" value="" name="type[]"> Referral:
					<?php echo Form::text('source_referral', '', array('placeholder' => 'Note if "Other"', 'class' => 'input-large', 'name' => 'source_referral', 'id' => 'source_referral', 'disabled' => 'disabled')); ?>
				</div>
				<div>
					<input type="checkbox" id="sourceCheckbox6" value="" name="type[]"> Other:&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo Form::text('source_other', '', array('placeholder' => 'Note if "Other"', 'class' => 'input-large', 'name' => 'source_other', 'id' => 'source_other', 'disabled' => 'disabled')); ?>
				</div>
			</div>
		</div>
		<div>
			<?php echo Form::text('symptoms', $jobs['0']->job_symptoms, array('placeholder' => 'Symptoms', 'class' => 'input-small', 'name' => 'symptoms')); ?>
		</div>
		<div>
			<textarea placeholder="Notes" id="note" value="" class="textarea" rows="6" name="note">@foreach ($jobs['0']->notes as $note) {{ $note->created_at." - ".$note->note."\n" }} @endforeach</textarea>
		</div>
	</div>
	<div>
		<?php echo Form::submit('Save', ['class' => 'btn btn-small btn-primary']);?>
		<?php echo Form::submit('Schedule Appt.', ['class' => 'btn btn-small btn-success']);?>
		<?php echo Form::close(); ?>
	</div>
</div>

@stop

@section('scripts')
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
	<script src="{{ asset('js/maskedinput.js') }}"></script>
	<script src="{{ asset('js/customer.js') }}"></script>
@stop

