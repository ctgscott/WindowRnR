@extends('layouts.default'){{-- Web site Title --}}@section('title')Edit Lead Details@stop@section('styles')<link href="{{ asset('css/customer.css') }}" rel="stylesheet"><script type='text/javascript' src="{{ asset('js/jquery-1.10.2.min.js') }}"></script><script type='text/javascript' src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>@stop{{-- Content --}}@section('content')<div class="well well-small">	{{ Form::open(array('action' => 'CustomersController@store', 'class' => 'form-inline')) }}			<div>		<h4><em>Customer Information:</em></h4>		<input placeholder="Last Name" class="input-small" name="l_name" type="text" value="" required>		<input placeholder="First Name" class="input-small" name="f_name" type="text" value="" required>		<?php echo Form::text('phone', '', array('placeholder' => 'Phone', 'class' => 'input-small', 'id' => 'phone')); ?>		<?php echo Form::text('alt_phone', '', array('placeholder' => 'Alt. Phone', 'class' => 'input-small', 'id' => 'phone2')); ?>		<?php echo Form::text('email', '', array('placeholder' => 'email', 'class' => 'input-small')); ?>	</div>	<hr>	<h4><em>Job & Jobsite Information:</em></h4>	<div class="row-fluid">		<div class="span12">			<input placeholder="Jobsite Address" class="input-small" name="address" type="text" value="" required>			<?php echo Form::text('city', '', array('placeholder' => 'City', 'class' => 'input-small')); ?>			<input placeholder="Zip" class="input-small" name="zip" type="text" id="zip" value="">			<?php echo Form::text('built', '', array('placeholder' => 'Year Built', 'class' => 'input-small', 'id' => 'built')); ?>		</div>		<div class="row">			<div class="span6 well well-small" name="checkbox">				<div id="checkbox_label">Window Type(s):</div>				<div>					<input type="checkbox" id="typeCheckbox1" value="Wood" name="type[]"> Wood&nbsp;&nbsp;					<input type="checkbox" id="typeCheckbox2" value="Steel" name="type[]"> Steel&nbsp;&nbsp;					<input type="checkbox" id="typeCheckbox3" value="Aluminum" name="type[]"> Aluminum&nbsp;&nbsp;					<input type="checkbox" id="typeCheckbox4" value="Vinyl" name="type[]"> Vinyl&nbsp;&nbsp;				</div>				<div id="checkbox_middle">					<input type="checkbox" id="typeCheckbox5" value="Double Hung" name="type[]"> Double Hung&nbsp;&nbsp;					<input type="checkbox" id="typeCheckbox7" value="Casement" name="type[]"> Casement&nbsp;&nbsp;					<input type="checkbox" id="typeCheckbox8" value="Slider" name="type[]"> Slider&nbsp;&nbsp;					<input type="checkbox" id="typeCheckbox9" value="Awning" name="type[]"> Awning&nbsp;&nbsp;				</div>				<div>					<input type="checkbox" id="typeCheckbox6" value="" name="type[]"> Other:					<?php echo Form::text('type_other', '', array('placeholder' => 'Note if "Other"', 'class' => 'input-large', 'name' => 'type_other', 'id' => 'type_other', 'disabled' => 'disabled')); ?>				</div>			</div>			<div class="span6 well well-small" name="source">				<em>Source:&nbsp;&nbsp;</em>				<div id="source">					<input type="checkbox" id="sourceCheckbox1" value="Angies" name="type[]"> Angies&nbsp;&nbsp;					<input type="checkbox" id="sourceCheckbox2" value="Yelp" name="type[]"> Yelp&nbsp;&nbsp;					<input type="checkbox" id="sourceCheckbox3" value="Google" name="type[]"> Google&nbsp;&nbsp;					<input type="checkbox" id="sourceCheckbox4" value="LA Conservancy" name="type[]"> LA Conserv.&nbsp;&nbsp;				</div>				<div>					<input type="checkbox" id="sourceCheckbox5" value="" name="type[]"> Referral:					<?php echo Form::text('source_referral', '', array('placeholder' => 'Note if "Other"', 'class' => 'input-large', 'name' => 'source_referral', 'id' => 'source_referral', 'disabled' => 'disabled')); ?>				</div>				<div>					<input type="checkbox" id="sourceCheckbox6" value="" name="type[]"> Other:&nbsp;&nbsp;&nbsp;&nbsp;					<?php echo Form::text('source_other', '', array('placeholder' => 'Note if "Other"', 'class' => 'input-large', 'name' => 'source_other', 'id' => 'source_other', 'disabled' => 'disabled')); ?>				</div>			</div>		</div>		<div>			<?php echo Form::text('symptoms', '', array('placeholder' => 'Symptoms', 'class' => 'input-small', 'name' => 'symptoms')); ?>		</div>		<div>			<textarea placeholder="Notes" id="note" value="" class="textarea" rows="6" name="note"></textarea>		</div>	</div>	<div>		<?php echo Form::submit('Save', ['class' => 'btn btn-small btn-primary']);?>		<?php echo Form::submit('Schedule Appt.', ['class' => 'btn btn-small btn-success']);?>		<?php echo Form::close(); ?>	</div></div>@stop@section('scripts')	<script src="{{ asset('js/bootstrap.min.js') }}"></script>	<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>	<script src="{{ asset('js/maskedinput.js') }}"></script>	<script src="{{ asset('js/customer.js') }}"></script>@stop