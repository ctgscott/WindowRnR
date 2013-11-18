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
<script type='text/javascript' src="{{ asset('ckeditor/ckeditor.js') }}"></script>
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
		<input class="input-small" name="cust" type="text" value="Cust. ID: {{ $custDetail['0']->id }}" disabled/>
		<input class="input-small" name="custID" type="hidden" value="{{ $custDetail['0']->id }}" />
		<input placeholder="Last Name" class="input-small" name="l_name" type="text" value="{{ $custDetail['0']->l_name }}" required>
		<input placeholder="First Name" class="input-small" name="f_name" type="text" value="{{ $custDetail['0']->f_name }}" required>
		<?php echo Form::text('phone', $custDetail[0]->phone, array('placeholder' => 'Phone', 'class' => 'input-small', 'id' => 'phone' )); ?>
		<?php echo Form::text('alt_phone', $custDetail[0]->alt_phone, array('placeholder' => 'Alt. Phone', 'class' => 'input-small', 'id' => 'phone2')); ?>
		<?php echo Form::text('email', $custDetail[0]->email, array('placeholder' => 'email', 'class' => 'input-small')); ?>
	</div>
	<div>
		<h5><em>Customer billing information:</em></h5>
		<input placeholder="Billing Address" class="input-small address" type="text" name="billing_address" value="{{ $custDetail['0']->billing_address }}" >
		<input placeholder="City" class="input-small city" name="billing_city" type="text" value="{{ $custDetail['0']->billing_city }}" >
		<input placeholder="State" class="input-small state" name="state" type="text" value="{{ $custDetail['0']->billing_state }}" >
		<input placeholder="Zip" class="input-small zip" name="billing_zip" type="text" value="{{ $custDetail['0']->billing_zip }}" >
	</div>
	<hr>
	<h4><em>Job & Jobsite Information:</em></h4>
	<div class="row-fluid">
		<div class="span12">
			<input class="input-small" name="job" type="text" value="Job ID: {{ $jobs['0']->id }}" disabled/>
			<input class="input-small" name="jobID" type="hidden" value="{{ $jobs['0']->id }}" id="jobID" />
			<input placeholder="Jobsite Address" class="input-small address" name="address" type="text" value="{{ $jobs['0']->address }}" required>
			<?php echo Form::text('city', $jobs['0']->city, array('placeholder' => 'City', 'class' => 'input-small city')); ?>
			<input placeholder="Zip" class="input-small zip" name="zip" type="text" id="zip" value="{{ $jobs['0']->zip }}">
			<?php echo Form::text('built', $jobs['0']->built, array('placeholder' => 'Year Built', 'class' => 'input-small built', 'id' => 'built')); ?>
		</div>
		<div class="row">
			<div class="span6 well well-small" name="checkbox">
				<div id="window_type" class="style">Window Material(s) & Style(s)
					<a id="btnAdd" class="btnAdd">Add'l Group <i class="icon-plus" id="add"></i></a>
				</div>
				<div id="parent">
					<?php  $i=0; ?>
					@foreach ($window_totals as $total)
					<?php $i++; ?>
						<div id='{{ "style_group_".$i }}' class="clonedSection">
							<input id='{{ "windowTotalID".$i }}' class="input-mini" type="hidden" name='{{ "windowTotalID".$i }}' value="{{ $total->id }}">
							<input placeholder="Qty: (#)" id='{{ "qty".$i }}' class="input-mini" type="text" name='{{ "qty".$i }}' value="{{ $total->qty }}">
							{{ Form::select('material'.$i, array('Wood' => 'Wood', 'Steel' => 'Steel', 'Aluminum' => 'Aluminum', 'Vinyl' => 'Vinyl'), $total->material, array('class' => 'materialSelect')) }}
							{{ Form::select('style'.$i, array('Double Hung' => 'Double Hung', 'Casement' => 'Casement', 'Slider' => 'Slider', 'Awning' => 'Awning', 'Hopper' => 'Hopper', 'Transom' => 'Transom', 'Picture' => 'Picture', 'Other' => 'Other'), $total->style, array('class' => 'styleSelect')) }}						
						</div>
					@endforeach
				</div>
			</div>
			<div class="span6 well well-small" name="source">
				<em>Source:&nbsp;&nbsp;</em>
				<div id="source">
					<?php 
						if (isset($jobs['0']->lead_source)) {
							if (strpos($jobs['0']->lead_source, 'Angies') !==false) {
								echo Form::checkbox('lead_source[]', 'Angies', true).' Angies&nbsp;&nbsp;';
							} else {
								echo Form::checkbox('lead_source[]', 'Angies').' Angies&nbsp;&nbsp;';
							}
							if (strpos($jobs['0']->lead_source, 'Yelp') !==false) {
								echo Form::checkbox('lead_source[]', 'Yelp', true).' Yelp&nbsp;&nbsp;';
							} else {
								echo Form::checkbox('lead_source[]', 'Yelp').' Yelp&nbsp;&nbsp;';
							}
							if (strpos($jobs['0']->lead_source, 'Google') !==false) {
								echo Form::checkbox('lead_source[]', 'Google', true).' Google&nbsp;&nbsp;';
							} else {
								echo Form::checkbox('lead_source[]', 'Google').' Google&nbsp;&nbsp;';
							}
							if (strpos($jobs['0']->lead_source, 'LA') !==false) {
								echo Form::checkbox('lead_source[]', 'LA Conservancy', true).' LA Conserv.&nbsp;&nbsp;';
							} else {
								echo Form::checkbox('lead_source[]', 'LA Conservancy').' LA Conserv.&nbsp;&nbsp;';
							}
						} else {
							echo Form::checkbox('lead_source[]', 'Angies').' Angies&nbsp;&nbsp;';
							echo Form::checkbox('lead_source[]', 'Yelp').' Yelp&nbsp;&nbsp;';
							echo Form::checkbox('lead_source[]', 'Google').' Google&nbsp;&nbsp;';
							echo Form::checkbox('lead_source[]', 'LA Conservancy').' LA Conserv.&nbsp;&nbsp;';
						}
					?>
				</div>
				<div>
					<?php
						if (isset($jobs['0']->lead_source)) {
							if (strpos($jobs['0']->lead_source, 'Other') !==false) {
								$other = explode( 'Other, ', $jobs['0']->lead_source);
								echo '<input type="checkbox" id="sourceCheckbox5" value="Other" name="lead_source[]" checked="checked"> Referral or Other:&nbsp;';
								echo Form::text('source_referral', $other[1], array('placeholder' => 'Note Referral or Other', 'class' => 'input-large', 'name' => 'lead_source[]', 'id' => 'source_referral'));
							} else {
								echo '<input type="checkbox" id="sourceCheckbox5" value="Other" name="lead_source[]"> Referral or Other:';
								echo Form::text('source_referral', '', array(
									'placeholder' => 'Note Referral or Other', 
									'class' => 'input-large', 
									'name' => 'lead_source[]', 
									'id' => 'source_referral', 
									'disabled' => 'disabled'));
							}
						}
					?>
			<!--		<input type="checkbox" id="sourceCheckbox5" value="Other" name="lead_source[]"> Referral or Other: -->
					<?php //echo Form::text('source_referral', '', array('placeholder' => 'Note Referral or Other', 'class' => 'input-large', 'name' => 'lead_source[]', 'id' => 'source_referral', 'disabled' => 'disabled')); ?>
				</div>
<!--				<div>
					<input type="checkbox" id="sourceCheckbox5" value="" name="type[]"> Referral:
					<?php// echo Form::text('source_referral', '', array('placeholder' => 'Note if "Other"', 'class' => 'input-large', 'name' => 'source_referral', 'id' => 'source_referral', 'disabled' => 'disabled')); ?>
				</div>
				<div>
					<input type="checkbox" id="sourceCheckbox6" value="" name="type[]"> Other:&nbsp;&nbsp;&nbsp;&nbsp;
					<?php //echo Form::text('source_other', '', array('placeholder' => 'Note if "Other"', 'class' => 'input-large', 'name' => 'source_other', 'id' => 'source_other', 'disabled' => 'disabled')); ?>
				</div>
-->			</div>
		</div>
<!--		<div>
			<?php //echo Form::text('symptoms', $jobs['0']->symptoms, array('placeholder' => 'Symptoms', 'class' => 'input-small', 'name' => 'symptoms')); ?>
		</div>
-->		<div>
			<h4><em>Add Notes:</em></h4>
			<textarea placeholder="New Notes" id="newNote" value="" class="textarea" rows="2" name="newNote"></textarea>
		</div>
		<div>
			<h4><em>File Notes:</em></h4>
			<ul>
				@foreach($jobs['0']->notes as $note){{ "<li class='oldNote'><em>".date('M. d, Y \(g:ia\)', strtotime($note->created_at)).":</em> <strong>".$note->note."</strong></li>" }}@endforeach
			</ul>
		</div>
		<script>
			CKEDITOR.replace('newNote');
		</script>
	</div>
	<div>
		<?php echo Form::submit('Update', ['class' => 'btn btn-small btn-primary']);?>
		<?php echo Form::button('Schedule Appt.', ['class' => 'btn btn-small btn-success btn-schedule', 'id' => 'btnSchedule']);?>
	</div>
</div>

@stop

@section('scripts')
<!--	<script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
	<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
	<script src="{{ asset('js/maskedinput.js') }}"></script>
	<script src="{{ asset('js/customer.js') }}"></script>
@stop

