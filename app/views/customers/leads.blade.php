@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
Log In
@stop

@section('styles')
<link href="{{ asset('css/customer.css') }}" rel="stylesheet">
<script type='text/javascript' src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
@stop

{{-- Content --}}
@section('content')
<h4>Leads</h4>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active tab"><a>Leads</a></li>
    <li class="tab"><a href="{{ URL::to('customers/estimates') }}">Estimates</a></li>
	<li class="tab"><a href="{{ URL::to('customers/contracts') }}">Contracts</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active fade in">
      <p>I'm in Section 1.</p>
    </div>
  </div>
</div>
@stop