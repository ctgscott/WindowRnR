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
			$avatar = DB::table('profiles')->where('id', '=', $calID)->pluck('avatar');
			$start = date('c',$start);
			$end = date('c',$end);
		//	$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $start, 'timeMax' => $end);
			$params = array('singleEvents' => 'true', 'orderBy' => 'updated', 'timeMin' => $start, 'timeMax' => $end);
			$eventList = $cal->events->listEvents($newCal, $params);
			$firephp->log($eventList, 'eventList');
			
			dump_r($eventList);

			foreach ($eventList['items'] as $event)
			{
				if (isset($event['location'])) {
					$address = urlencode($event['location']);
				} else {
					$address = null;
					$event['location'] = null;
				}
	set_time_limit(90);
				$latlng = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$address."&sensor=false"));
//				$firephp->log($latlng, '$latlng');
				if (isset($latlng->results[0]->geometry->location->lat)) {
					$lat = $latlng->results[0]->geometry->location->lat;
					$lng = $latlng->results[0]->geometry->location->lng;
				} else {
					$lat = null;
					$lng = null;
				}

				$now = date("Y-m-d H:i:s");
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

				$count = DB::table('events')
					->select('id')
					->where('google_event_id', '=', $event['id'])
					->count();
//				$firephp->log($count, '$count');

				$updated = strtotime($event['updated']);
//				$firephp->log($updated, '$updated');
				if ($count ==1) {
					DB::table('events')
						->where('google_event_id', '=', $event['id'])
						->where('updated_at', '!=', $event['updated'])
						->update(array(
							'google_event_id' => $event['id'],
							'google_cal_id' => $event['organizer']['email'],
							'cal_user_id' => $calID,
							'avatar' => $avatar,
							'start' => $eventStart,
							'end' => $eventEnd,
							'location' => $event['location'],
							'description' => $description,
							'allDay' => $event['all_day'],
							'title' => $event['summary'],
							'created_by' => $event['creator']['email'],
							'created_at' => $now,
							'updated_at' => $event['updated'],
							'lat' => $lat,
							'lng' => $lng
						));
				} else if ($count == 0) {
//					dump_r($latlng);
//					$firephp->log($latlng, '$latlng');
//					$firephp->log($latlng->results[0], '$latlng.results[0].geometry.location.lat');
					
					$result = DB::table('events')->insert(array(
						'google_event_id' => $event['id'],
						'google_cal_id' => $event['organizer']['email'],
						'cal_user_id' => $calID,
						'avatar' => $avatar,
						'start' => $eventStart,
						'end' => $eventEnd,
						'location' => $event['location'],
						'description' => $description,
						'allDay' => $event['all_day'],
						'title' => $event['summary'],
						'created_by' => $event['creator']['email'],
						'created_at' => $now,
						'updated_at' => $event['updated'],
						'lat' => $lat,
						'lng' => $lng
						)
					);

					echo $result;
				}
			}
		}
	}
	
	public static function updateEvents($start, $end, $gCalID)
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
//			$updatedMin = date('c');
//			$newCal = DB::table('profiles')->where('id', '=', $calID)->pluck('google_calendar_id');
//			$avatar = DB::table('profiles')->where('id', '=', $calID)->pluck('avatar');
//			$firstRow = DB::table('events')->where('cal_user_id', $calID)->first();
//			$latestUpdate = $firstRow->updated_at;
			$start = date('c',$start);
			$end = date('c',$end);
			$params = array(
				'singleEvents' => 'true', 
			//	'maxResults' => 25, 
			//	'orderBy' => 'updated', 
				'orderBy' => 'startTime', 
			//	'updatedMin' => date('c', 1389764791),
			//	'updatedMin' => $updatedMin, 
				'timeMin' => $start, 
				'timeMax' => $end
			);
			$eventList = $cal->events->listEvents($gCalID, $params);
			$firephp->log($eventList, 'eventList');
//			$firephp->log($firstRow);
//			$firephp->log($latestUpdate);
			
//			Schema::dropIfExists('temp_events');
			if (Schema::hasTable('temp_events'))
			{
			} else {
				Schema::create('temp_events', function($table) {
					$table->increments('id');
					$table->string('google_event_id')->unique();
					$table->string('status');
					$table->string('htmlLink');
					$table->string('summary')->nullable();
					$table->string('location')->nullable();
					$table->tinyInteger('all_day');
					$table->string('creatorEmail');
					$table->string('organizerEmail');
					$table->integer('cal_user_id');
					$table->timestamp('start');
					$table->timestamp('end');
					$table->timestamp('created_at');
					$table->timestamp('updated_at', 6)->index();
				});
			}
			
			$totalResult = [];
			set_time_limit(150); 
			
			do {
				if (isset($eventList['nextPageToken'])) {
					$params2 = array(
						'orderBy' => 'updated', 
						'pageToken' => $eventList['nextPageToken']
					);
					$eventList= $cal->events->listEvents($gCalID, $params2);
					$firephp->log($eventList, 'eventList');
					foreach ($eventList['items'] as $event)
					{
						if (!isset($event['location'])) {
							$event['location'] = null;
						}

						if (!isset($event['summary'])) {
							$event['summary'] = null;
						}
						
						if (isset($event['organizer']['email'])) {
							$event['cal_user_id'] =  DB::table('profiles')
								->where('google_calendar_id', $event['organizer']['email'])
								->pluck('user_id');
						}

						if ($event['status'] != 'cancelled') {
							if (isset($event['start']['date'])) {
								$event['all_day'] = 1;
								$eventStart = $event['start']['date'];
								$eventEnd = $event['end']['date'];
							} else {
								$event['all_day'] = 0;
								$eventStart = $event['start']['dateTime'];
								$eventEnd = $event['end']['dateTime'];
							}
							DB::table('temp_events')->insert(
								array(
									'google_event_id' => $event['id'],
									'status' => $event['status'],
									'htmlLink' => $event['htmlLink'],
									'summary' => $event['summary'],
									'location' => $event['location'],
									'all_day' => $event['all_day'],
									'creatorEmail' => $event['creator']['email'],
									'organizerEmail' => $event['organizer']['email'],
									'cal_user_id' => $event['cal_user_id'],
									'start' => $eventStart,
									'end' => $eventEnd,
									'created_at' => $event['created'],
									'updated_at' => $event['updated']
								)
							);
						} else {
							DB::table('temp_events')->insert(
								array(
									'google_event_id' => $event['id'],
									'status' => $event['status']
								)
							);
						}
					};
				} else {
					foreach ($eventList['items'] as $event)
					{
						if (!isset($event['location'])) {
							$event['location'] = null;
						}

						if (!isset($event['summary'])) {
							$event['summary'] = null;
						}

						if (isset($event['organizer']['email'])) {
							$event['cal_user_id'] =  DB::table('profiles')
								->where('google_calendar_id', $event['organizer']['email'])
								->pluck('user_id');
						}

						if ($event['status'] != 'cancelled') {
							if (isset($event['start']['date'])) {
								$event['all_day'] = 1;
								$eventStart = $event['start']['date'];
								$eventEnd = $event['end']['date'];
							} else {
								$event['all_day'] = 0;
								$eventStart = $event['start']['dateTime'];
								$eventEnd = $event['end']['dateTime'];
							}
							DB::table('temp_events')->insert(
								array(
									'google_event_id' => $event['id'],
									'status' => $event['status'],
									'htmlLink' => $event['htmlLink'],
									'summary' => $event['summary'],
									'location' => $event['location'],
									'all_day' => $event['all_day'],
									'creatorEmail' => $event['creator']['email'],
									'organizerEmail' => $event['organizer']['email'],
									'cal_user_id' => $event['cal_user_id'],
									'start' => $eventStart,
									'end' => $eventEnd,
									'created_at' => $event['created'],
									'updated_at' => $event['updated']
								)
							);
						} else {
							DB::table('temp_events')->insert(
								array(
									'google_event_id' => $event['id'],
									'status' => $event['status']
								)
							);
						}
					};
				}

			}while(isset($eventList['nextPageToken']) && !empty($eventList['nextPageToken']));
		}
	}

	public static function updateEventsTable() 
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		/** 
		 * Events found in Google but not found in
		 * the application's calendar.
		 * Update the app events table as appropriate
		 **/
		 $firephp->log('start');
		 $appMissing = DB::table('temp_events')
			->leftJoin('events', 'temp_events.google_event_id', '=', 'events.google_event_id')
			->whereNull('events.google_event_id')
		//	->where('temp_events.status', '!=', 'cancelled')
		//	->where('temp_events.location', '!=', null)
			->select('temp_events.*')
			->get();
			$firephp->log($appMissing, 'appMissing');

		foreach ($appMissing as $event)
		{
			if($event->summary == null) {
				$event->summary = 'x';
			}

			if (isset($event->location)) {
				$address = urlencode($event->location);
			} else {
				$address = null;
				$event->location = null;
			}

			$latlng = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$address."&sensor=false"));
			if (isset($latlng->results[0]->geometry->location->lat)) {
				$lat = $latlng->results[0]->geometry->location->lat;
				$lng = $latlng->results[0]->geometry->location->lng;
			} else {
				$lat = null;
				$lng = null;
			}
			
			$avatar = DB::table('profiles')->where('google_calendar_id', '=', $event->organizerEmail)->pluck('avatar');

			DB::table('events')->insert(
				array(
					'google_event_id' => $event->google_event_id,
					'status' => $event->status,
					'htmlLink' => $event->htmlLink,
					'title' => $event->summary,
					'location' => $event->location,
					'allDay' => $event->all_day,
					'avatar' => $avatar,
					'cal_user_id' => $event->cal_user_id,
					'creatorEmail' => $event->creatorEmail,
					'google_cal_id' => $event->organizerEmail,
					'start' => $event->start,
					'end' => $event->end,
					'lat' => $lat,
					'lng' => $lng,
					'created_at' => $event->created_at,
					'updated_at' => $event->updated_at
				)
			);
		}

		/** 
		 * Events found in Google as 'Canceled' but 'Confirmed'
		 * or 'Tentative' in the application's calendar.
		 * Update the app events table as appropriate
		 **/

		/** 
		 * Events found in the app but not found in
		 * Google's calendar.  Update Google
		 * as appropriate
		 **/

/*		$googMissing = DB::table('events')
			->leftJoin('temp_events', 'events.google_event_id', '=', 'temp_events.google_event_id')
 			->whereNull('temp_events.google_event_id')
			->select('temp_events.google_event_id AS id', 'temp_events.updated_at AS updated')
			->get();
			$firephp->log(count($googMissing), 'googMissing');
*/
		Schema::dropIfExists('temp_events');
	}
	
	public static function getCalEvents($start = null, $end = null, $calID = 'all')
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

//		$firephp->log($calID, '$calID');

		if (isset($_GET['start'])) {
			$start = $_GET['start'];
		}
		
		if (isset($_GET['end'])) {
			$end = $_GET['end'];
		}

		if ($calID != 'all') {
			if($calID == 1) {
				$events = DB::table('calendar_1')
					->where('start', '>=', date('c',$start))
					->where('end', '<=', date('c',$end))
					->get();
			} else if ($calID == 2) {
				$events = DB::table('calendar_2')
					->where('start', '>=', date('c',$start))
					->where('end', '<=', date('c',$end))
					->get();
			} else if($calID == 3) {
				$events = DB::table('calendar_3')
					->where('start', '>=', date('c',$start))
					->where('end', '<=', date('c',$end))
					->get();
			}
		} else {
			$events = DB::table('calendar_all')
				->where('start', '>=', date('c',$start))
				->where('end', '<=', date('c',$end))
				->get();
		}
		$date = date('D, n/j', $start);
		$firephp->log($events, 'events for: '.$calID.' on '.$date);
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
