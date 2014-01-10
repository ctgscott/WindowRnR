<?php

class EventsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('events.index');
	}
	
	public static function getGoogleCalEvents($start, $end, $calID)
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';

		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$client = new Google_Client();
		$client->setApplicationName("WindowRnR");
		$cal = new Google_CalendarService($client);		

		if (isset($_SESSION['token'])) {
			$client->setAccessToken($_SESSION['token']);
		}

		if ($client->getAccessToken()) {
			$newCal = DB::table('profiles')->where('id', '=', $calID)->pluck('google_calendar_id');
			$start = date('c',$start);
			$end = date('c',$end);
			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $start, 'timeMax' => $end);
			$eventList = $cal->events->listEvents($newCal, $params);
			$firephp->log($eventList, 'eventList');
			
			dump_r($eventList);

			foreach ($eventList['items'] as $event)
			{
				$count = DB::table('events')
					->select('id')
					->where('google_event_id', '=', $event['id'])
					->count();
				$firephp->log($count, '$count');

				if ($count == 0) {
					$address = urlencode($event['location']);
					$latlng = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$address."&sensor=false"));
//					dump_r($latlng);
//					$firephp->log($latlng, '$latlng');
//					$firephp->log($latlng->results[0], '$latlng.results[0].geometry.location.lat');
					
					if (!isset($event['description'])) {
						$description = 'None';
					} else {
						$description = $event['description'];
					}
					if (isset($event['start']['date'])) {
						$event['all_day'] = 1;
						$eventStart = strtotime($event['start']['date']);
						$eventEnd = strtotime($event['end']['date']);
					} else {
						$event['all_day'] = 0;
						$eventStart = strtotime($event['start']['dateTime']);
						$eventEnd = strtotime($event['end']['dateTime']);
					}
					
					$now = date("Y-m-d H:i:s");
					$result = DB::table('events')->insert(array(
						'google_event_id' => $event['id'],
						'google_cal_id' => $event['organizer']['email'],
						'cal_user_id' => $calID,
						'start' => $eventStart,
						'end' => $eventEnd,
						'location' => $event['location'],
						'description' => $description,
						'allDay' => $event['all_day'],
						'title' => $event['summary'],
						'created_by' => $event['creator']['email'],
						'created_at' => $now,
						'lat' => $latlng->results[0]->geometry->location->lat,
						'lng' => $latlng->results[0]->geometry->location->lng
						)
					);

					echo $result;
				}
			}
		}
	}

	public static function getCalEvents($start, $end, $calID = 'all')
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$firephp->log($calID, '$calID');

		if ($calID != 'all') {
			$events = DB::table('events')
				->where('cal_user_id', '=', $calID)
				->where('start', '>=', $start)
				->where('end', '<=', $end)
				->get();
		} else {
			$events = DB::table('events')
				->where('start', '>=', $start)
				->where('end', '<=', $end)
				->get();
		}
		
		$firephp->log($events, 'events');
		return $events;
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('events.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('events.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('events.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
