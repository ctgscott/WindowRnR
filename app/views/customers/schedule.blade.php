@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
Log In
@stop

@section('styles')
<link href="{{ asset('css/customer.css') }}" rel="stylesheet">
<link rel='stylesheet' type='text/css' href="{{ asset('css/fullcalendar.css') }}" />
<script type='text/javascript' src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/fullcalendar.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/calendar.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/schedule.js') }}"></script>

@stop

{{-- Content --}}
@section('content')
<h4>Estimates Appointments</h4>
<span id="signinButton">
  <span
    class="g-signin"
    data-callback="signinCallback"
    data-clientid="9824738942-4g6mv5siudqkgb9768662jad4qhb5lir.apps.googleusercontent.com"
    data-cookiepolicy="single_host_origin"
    data-requestvisibleactions="http://schemas.google.com/AddActivity"
    data-scope="https://www.googleapis.com/auth/calendar">
  </span>
</span>
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

@stop

@section('scripts')
<script type="text/javascript">
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/client:plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
	
	function signinCallback(authResult) {
		if (authResult['access_token']) {
			// Successfully authorized
			// Hide the sign-in button now that the user is authorized, for example:
			document.getElementById('signinButton').setAttribute('style', 'display: none');
		} else if (authResult['error']) {
			// There was an error.
			// Possible error codes:
			//   "access_denied" - User denied access to your app
			//   "immediate_failed" - Could not automatically log in the user
			// console.log('There was an error: ' + authResult['error']);
		}
	}
</script>
@stop
