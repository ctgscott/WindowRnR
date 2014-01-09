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
		$newCal = DB::table('profiles')->where('id', '=', $calID)->pluck('google_calendar_id');
		$start = date('c',$start);
		$end = date('c',$end);
		
		if (isset($_SESSION['token'])) {
			$client->setAccessToken($_SESSION['token']);
		}

		if ($client->getAccessToken()) {
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
					
					$result = DB::table('events')->insert(array(
						'google_event_id' => $event['id'],
						'google_cal_id' => $event['organizer']['email'],
						'start' => $eventStart,
						'end' => $eventEnd,
						'location' => $event['location'],
						'description' => $description,
						'all_day' => $event['all_day'],
						'title' => $event['summary'],
						'created_by' => $event['creator']['email']
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

		if (! $calID == 'all') {
			$newCal = DB::table('profiles')->where('id', '=', $calID)->pluck('google_calendar_id');
			$events = DB::table('events')
				->where('google_event_id', '=', $newCal)
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
