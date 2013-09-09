@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
Log In
@stop

@section('styles')
<link href="{{ asset('css/customer.css') }}" rel="stylesheet">
@stop

{{-- Content --}}
@section('content')
<div class="tabbable"> <!-- Only required for left/right tabs -->
	<ul class="nav nav-tabs">
		<li class="active tab" id="tab_1"><a href="#tab1" data-toggle="tab">Leads</a></li>
		<li class="tab" id="tab_2"><a href="#tab2" data-toggle="tab">Estimate Appointments</a></li>
		<li class="tab" id="tab_3"><a href="#tab3" data-toggle="tab">Contracts</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active fade in" id="tab1">
			<div class="well well-small">
				{{ Form::open(array('action' => 'CustomersController@store', 'class' => 'form-inline')) }}		
				<div>
					<h4><em>Customer Information:</em></h4>
					<input placeholder="Last Name" class="input-small" name="l_name" type="text" value="" required>
					<input placeholder="First Name" class="input-small" name="f_name" type="text" value="" required>
					<?php echo Form::text('phone', '', array('placeholder' => 'Phone', 'class' => 'input-small', 'id' => 'phone')); ?>
					<?php echo Form::text('alt_phone', '', array('placeholder' => 'Alt. Phone', 'class' => 'input-small', 'id' => 'phone2')); ?>
					<?php echo Form::text('email', '', array('placeholder' => 'email', 'class' => 'input-small')); ?>
				</div>
				<hr>
				<h4><em>Job & Jobsite Information:</em></h4>
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="span7">
								<div>
									<input placeholder="Jobsite Address" class="input-small" name="address" type="text" value="" required>
									<?php echo Form::text('city', '', array('placeholder' => 'City', 'class' => 'input-small')); ?>
									<input placeholder="Zip" class="input-small" name="zip" type="text" id="zip" value="">
									<?php echo Form::text('built', '', array('placeholder' => 'Year Built', 'class' => 'input-small', 'id' => 'built')); ?>
								</div>
								<div>
									<?php echo Form::text('symptoms', '', array('placeholder' => 'Symptoms', 'class' => 'input-small', 'name' => 'symptoms')); ?>
								</div>
								<div>
									<textarea placeholder="Notes" id="note" value="" class="textarea" rows="6" name="note"></textarea>
								</div>
							</div>
							<div class="span5">
								<div class="well well-small" name="checkbox">
									<div id="checkbox_label">Window Type(s)</div>
									<div>
										<input type="checkbox" id="typeCheckbox1" value="Wood DH" name="type[]"> Wood DH&nbsp;&nbsp;
										<input type="checkbox" id="typeCheckbox2" value="Wood CM" name="type[]"> Wood Csmt&nbsp;&nbsp;
										<input type="checkbox" id="typeCheckbox3" value="Steel CM" name="type[]"> Steel Csmt
									</div>
									<div id="checkbox_middle">
										<input type="checkbox" id="typeCheckbox4" value="Aluminum" name="type[]"> Aluminum&nbsp;&nbsp;
										<input type="checkbox" id="typeCheckbox5" value="Vinyl" name="type[]"> Vinyl
									</div>
									<div>
										<input type="checkbox" id="typeCheckbox6" value="" name="type[]"> Other:
										<?php echo Form::text('type_other', '', array('placeholder' => 'Note if "Other"', 'class' => 'input-large', 'name' => 'type_other', 'id' => 'type_other', 'disabled' => 'disabled')); ?>
									</div>
								</div>
								<div class="well well-small" name="source">
									<em>Source:&nbsp;&nbsp;</em>
									<div id="source">
										<input class="radio" name="lead_source" type="radio" value="Angies" id="radio_lead_main1"><label for="angies_list">&nbsp;Angies&nbsp;&nbsp;</label>
										<input class="radio" name="lead_source" type="radio" value="Yelp" id="radio_lead_main2"><label for="yelp">&nbsp;Yelp&nbsp;&nbsp;</label>
										<input class="radio" name="lead_source" type="radio" value="Google" id="radio_lead_main3"><label for="google">&nbsp;Google&nbsp;&nbsp;</label>
										<input class="radio" name="lead_source" type="radio" value="LA Conserv" id="radio_lead_main4"><label for="la_conserv">&nbsp;LA Cons.</label>
									</div>
									<div>
										<input class="radio" name="lead_source" type="radio" value="Other: " id="radio_lead_other"><label for="other">&nbsp;Other: </label>
										<?php echo Form::text('lead_other', '', array('placeholder' => 'Note if "Other"', 'id' => 'text_lead_other', 'class' => 'input-large', 'disabled' => 'disabled')); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div>
					<?php echo Form::submit('Save', ['class' => 'btn btn-small btn-primary']);?>
					<?php echo Form::submit('Schedule Appt.', ['class' => 'btn btn-small btn-success']);?>
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
					<tbody>
						@foreach ($customers as $customer)
							<tr>
								<td>{{ $customer->job_id }}</td>
								<td>{{ date("n/j/y", strtotime($customer->created_at)) }}</td>
								<td><a href="#">{{ $customer->l_name }}</a></td>
								<td><a href="#">{{ $customer->address }}</a></td>
								<td>{{ $customer->city }}</td>
								<td>{{ $customer->built }}</td>
								<td>{{ $customer->phone }}</td>
								<td>{{ $customer->email }}</td>
								<td>
									<!--<button class="btn-mini btn-info" onClick="location.href='{{ URL::to('customer/edit') }}/{{ $customer->id}}'">Details</button>  -->
									<button class="btn-mini btn-danger" onClick="location.href='{{ URL::to('customers/archive') }}/{{ $customer->job_id}}'">Archive</button> 
									<!--<button class="btn-mini btn-success action_confirm radius" href="{{ URL::to('customer/delete') }}/{{ $customer->id}}" data-method="post">Schedule</button>-->
									<button class="btn-mini btn-success action_confirm radius" onClick="location.href='{{ URL::to('customers/schedule') }}/{{ $customer->job_id}}'">Schedule</button>
									<!--<button class="btn-mini btn-success action_confirm radius" href='#tab2' data-toggle="tab" id="schedButton">Schedule</button>-->
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane fade in" id="tab2">
			<p>Howdy, I'm in Section 2.</p>
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">
						
<?php
							use Ivory\GoogleMap\Map;
							use Ivory\GoogleMap\Helper\MapHelper;
							use Ivory\GoogleMap\Overlays\Animation;
							use Ivory\GoogleMap\Overlays\Marker;
							use Ivory\GoogleMap\Overlays\InfoWindow;
							use Ivory\GoogleMap\Events\MouseEvent;

							$map = new Map();

							$map->setAutoZoom(true);
							$map->setStylesheetOptions(array(
								'width'  => '100%',
								'height' => '300px',
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
						?>					
						
						
					</div>
				</div>
			</div>
			<div class="container">
				<iframe src="https://www.google.com/calendar/embed?mode=WEEK&amp;height=600&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=ctgscott%40gmail.com&amp;color=%23060D5E&amp;src=eerenee%40gmail.com&amp;color=%23B1365F&amp;ctz=America%2FLos_Angeles" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>	  
			</div>
		</div>
		<div class="tab-pane fade in" id="tab3">
		  <p>Howdy, I'm in Section 3.</p>
		</div>
	</div>
</div>

@stop

@section('scripts')
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
	<script src="{{ asset('js/maskedinput.js') }}"></script>
	<script src="{{ asset('js/customer.js') }}"></script>
@stop
