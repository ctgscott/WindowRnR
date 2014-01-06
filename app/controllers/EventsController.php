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
	
	public static function getGoogleEvents($start, $end, $cal)
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';

		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$client = new Google_Client();
		$client->setApplicationName("WindowRnR");
		$cal = new Google_CalendarService($client);
//		$start = date('c',$_GET['start']);
//		$end = date('c',$_GET['end']);
		
		if (isset($_SESSION['token'])) {
			$client->setAccessToken($_SESSION['token']);
		}

		if ($client->getAccessToken()) {
//			$rightNow = date('c');
			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $start, 'timeMax' => $end);
			$eventList = $cal->events->listEvents($cal, $params);
			$firephp->log($eventList, 'eventList');

//			$events = array();
			foreach ($eventList['items'] as $event)
			{
				$count = DB::table('events')
					->select('id')
					->where('google_event_id', '=', $event['id'])
					->count();
				$firephp->log($count, '$count');

				if ($count == 0) {
					if (!isset($event['description']) {
						$description = 'None';
					} else {
						$description = $event['description']
					})
					if (isset($event['start']['date']) {
						
					if ($event['all_day'] == 1) {
						$eventStart = $event['start']['date'];
						$eventEnd = $event['end']['date'];
					} else {
						$eventStart = $event['start']['dateTime'];
						$eventEnd = $event['end']['dateTime'];
					}
					
					DB::table('events')->insert(array(
						'google_event_id' => $event['id'],
						'google_cal_id' => $event['organizer']['email'],
						'start' => $eventStart,
						'end' => $eventEnd,
						'location' => $event['location'],
						'description' => $description,
						'all_day' => $event[''],
						'title' => $event['summary'],
						'created_by' => $event['creator']['email']
						)
					);
				}
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
