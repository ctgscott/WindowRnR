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
<h4>Estimates Appointments</h4>

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
@stop

@section('scripts')
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/customer.js') }}"></script>
@stop
