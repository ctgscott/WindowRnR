@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
Edit Lead Details
@stop

@section('styles')
<link href="{{ asset('css/customer.css') }}" rel="stylesheet">
<script type='text/javascript' src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/fieldAdd.js') }}"></script>
@stop

{{-- Content --}}
@section('content')
<div class="well well-small">
<?php 
	//echo "<pre>".var_dump($leadDetail)."</pre>";
	//echo "<pre>".var_dump($jobs)."</pre>";
?>
	
	{{ Form::open(array('action' => 'CustomersController@update', 'class' => 'form-inline')) }}		
	<div>
		<h4><em>Customer Information:</em></h4>
		<input class="input-small" type="text" name="custID" value="Cust. ID: {{ $custDetail['0']->id }}" disabled/>
		<input placeholder="Last Name" class="input-small" name="l_name" type="text" value="{{ $custDetail['0']->l_name }}" required>
		<input placeholder="First Name" class="input-small" name="f_name" type="text" value="{{ $custDetail['0']->f_name }}" required>
		<?php echo Form::text('phone', $custDetail[0]->phone, array('placeholder' => 'Phone', 'class' => 'input-small', 'id' => 'phone' )); ?>
		<?php echo Form::text('alt_phone', $custDetail[0]->alt_phone, array('placeholder' => 'Alt. Phone', 'class' => 'input-small', 'id' => 'phone2')); ?>
		<?php echo Form::text('email', $custDetail[0]->email, array('placeholder' => 'email', 'class' => 'input-small')); ?>
	</div>
	<div>
		<h5><em>Customer billing information:</em></h5>
		<input placeholder="Billing Address" class="input-small" type="text" name="billing_address" value="{{ $custDetail['0']->billing_address }}" >
		<input placeholder="City" class="input-small" name="billing_city" type="text" value="{{ $custDetail['0']->billing_city }}" >
		<input placeholder="State" class="input-small" name="state" type="text" value="{{ $custDetail['0']->billing_state }}" >
		<input placeholder="State" class="input-small" name="billing_zip" type="text" value="{{ $custDetail['0']->billing_zip }}" >
	</div>
	<hr>
	<h4><em>Job & Jobsite Information:</em></h4>
	<div class="row-fluid">
		<div class="span12">
			<input class="input-small" type="text" name="custID" value="Job ID: {{ $jobs['0']->id }}" disabled/>
			<input placeholder="Jobsite Address" class="input-small" name="address" type="text" value="{{ $jobs['0']->address }}" required>
			<?php echo Form::text('city', $jobs['0']->city, array('placeholder' => 'City', 'class' => 'input-small')); ?>
			<input placeholder="Zip" class="input-small" name="zip" type="text" id="zip" value="{{ $jobs['0']->zip }}">
			<?php echo Form::text('built', $jobs['0']->built, array('placeholder' => 'Year Built', 'class' => 'input-small', 'id' => 'built')); ?>
		</div>
		<div class="row">
			<div class="span6 well well-small" name="checkbox">
				<div id="window_type" class="style">Window Material & Style(s)
					<a id="btnAdd" class="btnAdd">Add'l Style</a>
				</div>
				<ul id="style_group_1" class="clonedSection">
					<select class="styleSelect">
						<option selected="selected">Material</option>
						<option>Wood</option>
						<option>Aluminum</option>
						<option>Vinyl</option>
					</select>
					<select class="styleSelect">
						<option selected="selected">Style</option>
						<option>Double Hung</option>
						<option>Casement</option>
						<option>Slider</option>
						<option>Awning</option>
						<option>Transom</option>
					</select>									
				</ul>
			</div>
			<div class="span6 well well-small" name="source">
				<em>Source:&nbsp;&nbsp;</em>
				<div id="source">
					<?php 
						if (isset($jobs['0']->lead_source)) {
							if (strpos($jobs['0']->lead_source, 'Angies') !==false) {
								echo Form::checkbox('type[]', 'Angies', true).' Angies&nbsp;&nbsp;';
							} else {
								echo Form::checkbox('type[]', 'Angies').' Angies&nbsp;&nbsp;';
							}
							if (strpos($jobs['0']->lead_source, 'Yelp') !==false) {
								echo Form::checkbox('type[]', 'Yelp', true).' Yelp&nbsp;&nbsp;';
							} else {
								echo Form::checkbox('type[]', 'Yelp').' Yelp&nbsp;&nbsp;';
							}
							if (strpos($jobs['0']->lead_source, 'Google') !==false) {
								echo Form::checkbox('type[]', 'Google', true).' Google&nbsp;&nbsp;';
							} else {
								echo Form::checkbox('type[]', 'Google').' Google&nbsp;&nbsp;';
							}
							if (strpos($jobs['0']->lead_source, 'LA') !==false) {
								echo Form::checkbox('type[]', 'LA Conservancy', true).' LA Conserv.&nbsp;&nbsp;';
							} else {
								echo Form::checkbox('type[]', 'LA Conservancy').' LA Conserv.&nbsp;&nbsp;';
							}
						} else {
							echo Form::checkbox('type[]', 'Angies').' Angies&nbsp;&nbsp;';
							echo Form::checkbox('type[]', 'Yelp').' Yelp&nbsp;&nbsp;';
							echo Form::checkbox('type[]', 'Google').' Google&nbsp;&nbsp;';
							echo Form::checkbox('type[]', 'LA Conservancy').' LA Conserv.&nbsp;&nbsp;';
						}
					?>
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
			<?php echo Form::text('symptoms', $jobs['0']->symptoms, array('placeholder' => 'Symptoms', 'class' => 'input-small', 'name' => 'symptoms')); ?>
		</div>
		<div>
			<textarea placeholder="New Notes" id="newNote" value="" class="textarea" rows="2" name="newNote"></textarea>
		</div>
		<div>
			<textarea placeholder="Notes" id="note" value="" class="textarea" rows="6" name="note" disabled>@foreach($jobs['0']->notes as $note){{ $note->created_at." - ".$note->note."\n" }}@endforeach</textarea>
		</div>
	</div>
	<div>
		<?php echo Form::submit('Update', ['class' => 'btn btn-small btn-primary']);?>
		<?php echo Form::button('Schedule Appt.', ['class' => 'btn btn-small btn-success']);?>
		<?php echo Form::close(); ?>
	</div>
</div>

@stop

@section('scripts')
<!--	<script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
	<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
	<script src="{{ asset('js/maskedinput.js') }}"></script>
	<script src="{{ asset('js/customer.js') }}"></script>
@stop

