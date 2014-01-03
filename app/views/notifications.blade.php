@if (count($errors->all()) > 0)
<div id="alert" class="collapse">
	<div class="alert alert-error alert-block">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Error</h4>
		Please check the form below for errors
	</div>
</div>
@endif

@if ($message = Session::get('_token'))
<div id="alert" class="collapse">
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-toggle="collapse" data-target="#alert">&times;</button>
		<h4>Success</h4>
		{{ $message }}
	</div>
</div>
@endif

@if ($message = Session::get('error'))
<div id="alert" class="collapse">
	<div class="alert alert-error alert-block">
		<button type="button" class="close" data-toggle="collapse" data-target="#alert">&times;</button>
		<h4>Error</h4>
		{{ $message }}
	</div>
</div>
@endif

@if ($message = Session::get('warning'))
<div id="alert" class="collapse">
	<div class="alert alert-warning alert-block">
		<button type="button" class="close" data-toggle="collapse" data-target="#alert">&times;</button>
		<h4>Warning</h4>
		{{ $message }}
	</div>
</div>
@endif

@if ($message = Session::get('info'))
<div id="alert" class="collapse">
	<div class="alert alert-info alert-block">
		<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
		<button type="button" class="close" data-toggle="collapse" data-target="#alert">&times;</button>
		<h4>Info</h4>
		{{ $message }}
	</div>
</div>
@endif
