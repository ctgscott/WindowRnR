	<div class="row-fluid">
		<div class="span3">
<!--			<p>Monday</p>
			<div class="container-fluid">
				<?php
/*					use Ivory\GoogleMap\Map;
					use Ivory\GoogleMap\Helper\MapHelper;
					use Ivory\GoogleMap\Overlays\Animation;
					use Ivory\GoogleMap\Overlays\Marker;
					use Ivory\GoogleMap\Overlays\InfoWindow;
					use Ivory\GoogleMap\Events\MouseEvent;

					$map = new Map();

					$map->setAutoZoom(true);
					$map->setStylesheetOptions(array(
						'width'  => '100%',
						'height' => '250px',
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
		<div class="span3">
			<p>Tuesday</p>
			<?php
/*				use Ivory\GoogleMap\Map;
				use Ivory\GoogleMap\Helper\MapHelper;
				use Ivory\GoogleMap\Overlays\Animation;
				use Ivory\GoogleMap\Overlays\Marker;
				use Ivory\GoogleMap\Overlays\InfoWindow;
				use Ivory\GoogleMap\Events\MouseEvent;
*/
/*				$map2 = new Map();

				$map2->setAutoZoom(true);
				$map2->setHtmlContainerId('map_canvas2');
				$map2->setStylesheetOptions(array(
					'width'  => '100%',
					'height' => '250px',
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
				
				$map2->addMarker($marker);
				$map2->addMarker($marker2);
				
				$mapHelper = new MapHelper();

				echo $mapHelper->render($map2);
			?>
		</div>
		<div class="span3">
			<p>Wednesday</p>
			<?php
/*				use Ivory\GoogleMap\Map;
				use Ivory\GoogleMap\Helper\MapHelper;
				use Ivory\GoogleMap\Overlays\Animation;
				use Ivory\GoogleMap\Overlays\Marker;
				use Ivory\GoogleMap\Overlays\InfoWindow;
				use Ivory\GoogleMap\Events\MouseEvent;
*/
/*				$map3 = new Map();

				$map3->setAutoZoom(true);
				$map3->setHtmlContainerId('map_canvas3');
				$map3->setStylesheetOptions(array(
					'width'  => '100%',
					'height' => '250px',
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
				
				$map3->addMarker($marker);
				$map3->addMarker($marker2);
				
				$mapHelper = new MapHelper();

				echo $mapHelper->render($map3);
			?>
		</div>
		<div class="span3">
			<p>Thursday</p>
			<?php
/*				use Ivory\GoogleMap\Map;
				use Ivory\GoogleMap\Helper\MapHelper;
				use Ivory\GoogleMap\Overlays\Animation;
				use Ivory\GoogleMap\Overlays\Marker;
				use Ivory\GoogleMap\Overlays\InfoWindow;
				use Ivory\GoogleMap\Events\MouseEvent;
*/
/*				$map4 = new Map();

				$map4->setAutoZoom(true);
				$map4->setHtmlContainerId('map_canvas4');
				$map4->setStylesheetOptions(array(
					'width'  => '100%',
					'height' => '250px',
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
				
				$map4->addMarker($marker);
				$map4->addMarker($marker2);
				
				$mapHelper = new MapHelper();

				echo $mapHelper->render($map4);
			?>
*/		</div>
	</div>  
