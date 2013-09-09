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
<h4>Contracts</h4>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="tab"><a href="{{ URL::to('customers/leads') }}">Leads</a></li>
    <li class="tab"><a href="{{ URL::to('customers/estimates') }}" >Estimates</a></li>
	<li class="active tab"><a href="#tab3" data-toggle="tab">Contracts</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active fade in">
      <p>Howdy, I'm in Section 3.</p>
    </div>
  </div>
</div>
@stop