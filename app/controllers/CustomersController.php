<?php



class CustomersController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( ! Sentry::check())
		{
			// User is not logged in, or is not activated
		    Session::flash('error', 'There was a problem accessing your account.');
			return Redirect::to('/');
		}
		else
		{
			// User is logged in
			$results['customers'] = DB::table('jobs')
				->join('customers', 'jobs.customer_id', '=', 'customers.id')
				->select('customers.id', 'customers.l_name', 'customers.f_name', 'customers.phone', 'customers.alt_phone', 'customers.email', 'jobs.id as job_id', 'jobs.created_at', 'jobs.created_by', 'jobs.address', 'jobs.city', 'jobs.built')
				->where('jobs.status', '=', 1)
				->where('jobs.archive', '=', 0)
				->get();
			
			return View::make('customers.index')->with($results);
		}
	}
	
	public function archive($id)
	{
		DB::table('jobs')
			->where('id', $id)
			->update(array('archive' => '1'));
		
		$user = Sentry::getUser();
		
		$noteAdd = new note;
		$noteAdd->job_id = $id;
		$noteAdd->user_id = $user->id;
		$noteAdd->note = 'Lead archived on '.date("n/j/Y (g:ia)", time()).' by: '.$user->first_name;
		$noteAdd->save();	
		
		Session::flash("success", "Job #".$id." archived.");
		return Redirect::to('customers');
	}

	public function getLeads()
	{
		return View::make('customers.leads')
			->with('customers', Customer::all());
	}

	public function getSchedule()
	{
		if ( ! Sentry::check())
		{
			// User is not logged in, or is not activated
		    Session::flash('error', 'There was a problem accessing your account.');
			return Redirect::to('/');
		}
		else
		{
			return View::make('customers.schedule');
		}
	}


	public function getScheduleID($id)
	{
		if ( ! Sentry::check())
		{
			// User is not logged in, or is not activated
		    Session::flash('error', 'There was a problem accessing your account.');
			return Redirect::to('/');
		}
		else
		{
			// User is logged in
			$results['lead'] = DB::table('jobs')
				->join('customers', 'jobs.customer_id', '=', 'customers.id')
				->join('notes', 'jobs.id', '=', 'notes.job_id')
				->select('customers.id', 'customers.l_name', 'customers.f_name', 'customers.phone', 'customers.alt_phone', 'customers.email', 'jobs.id as job_id', 'jobs.created_at', 'jobs.created_by', 'jobs.address', 'jobs.city', 'jobs.built')
				->where('jobs.id', '=', $id)
				->get();
				
//print_r($results['lead']);
//exit;			
//			return View::make('customers.schedule')->with($results);
			return Redirect::to('customers/schedule')->with($results);
		}
	}

/*	public static function EstimateSchedule()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';
		//session_start();

		$client = new Google_Client();
		$client->setApplicationName("Google Calendar PHP Starter Application");

		// Visit https://code.google.com/apis/console?api=calendar to generate your
		// client id, client secret, and to register your redirect uri.
		$client->setClientId('9824738942-4g6mv5siudqkgb9768662jad4qhb5lir.apps.googleusercontent.com');
		$client->setClientSecret('3hbp4TiSn_kAjlgw36IvB3_4');
		$client->setRedirectUri('http://Localhost:8000/customers/schedule');
		$client->setDeveloperKey('AIzaSyBOEw4SxexTFurahdUDK4Q6blrdM8xFD_8');
		$cal = new Google_CalendarService($client);
		if (isset($_GET['logout'])) {
		  unset($_SESSION['token']);
		}

		if (isset($_GET['code'])) {
		  $client->authenticate($_GET['code']);
		  $_SESSION['token'] = $client->getAccessToken();
		  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
		}

		if (isset($_SESSION['token'])) {
		  $client->setAccessToken($_SESSION['token']);
		}

		if ($client->getAccessToken()) {
			$calList = $cal->calendarList->listCalendarList();
//			print_r($calList);
//			exit;
			$rightNow = date('c');
			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $rightNow);
			$calList2 = $cal->events->listEvents('primary', $params);
			//print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";
			//print "<h1>Calendar List2</h1><pre>" . print_r($calList2, true) . "</pre>";
			$events = array();
			foreach ($calList2['items'] as $event)
			{
				$events[] = array(
					"title" => $event['summary'],
					"start" => $event['start']['dateTime'],
					"end" => $event['end']['dateTime'],
					"url" => $event['htmlLink'],
					//"url" => 'http://www.google.com',
					"allDay" => false
//					"location" => $event['location'],
//					"description" => $event['description']
				);
			}

			$_SESSION['token'] = $client->getAccessToken();
			return $events;
		} else {
		  $authUrl = $client->createAuthUrl();
		  print "<a class='login' href='$authUrl'>Connect Me!</a>";
		}
	}
*/	
	public static function EstimateSchedule()
	{
//		echo "A";
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';
//		echo "0";
		$client = new Google_Client();
//		echo "1";
		$client->setApplicationName("Google Calendar PHP Starter Application");
//		echo "2";
		$cal = new Google_CalendarService($client);

		if (isset($_SESSION['token'])) {
		  $client->setAccessToken($_SESSION['token']);
		}
		if ($client->getAccessToken()) {
//			echo "3";
			$calList = $cal->calendarList->listCalendarList();
			$rightNow = date('c');
			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $rightNow);
			$calList2 = $cal->events->listEvents('primary', $params);
			$events = array();
			foreach ($calList2['items'] as $event)
			{
				$events[] = array(
					"title" => $event['summary'],
					"start" => $event['start']['dateTime'],
					"end" => $event['end']['dateTime'],
					"url" => $event['htmlLink'],
					//"url" => 'http://www.google.com',
					"allDay" => false
//					"location" => $event['location'],
//					"description" => $event['description']
				);
			}
//			echo json_encode($events);
			return $events;
		}
		echo "4";
	}

	public static function EstimateSchedule2()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';
		//session_start();

		$client = new Google_Client();
		$client->setApplicationName("Google Calendar PHP Starter Application");

		// Visit https://code.google.com/apis/console?api=calendar to generate your
		// client id, client secret, and to register your redirect uri.
		$client->setClientId('9824738942-4g6mv5siudqkgb9768662jad4qhb5lir.apps.googleusercontent.com');
		$client->setClientSecret('3hbp4TiSn_kAjlgw36IvB3_4');
		$client->setRedirectUri('http://Localhost:8000/customers/schedule');
		$client->setDeveloperKey('AIzaSyBOEw4SxexTFurahdUDK4Q6blrdM8xFD_8');
		$cal = new Google_CalendarService($client);
		if (isset($_GET['logout'])) {
		  unset($_SESSION['token']);
		}

		if (isset($_GET['code'])) {
		  $client->authenticate($_GET['code']);
		  $_SESSION['token'] = $client->getAccessToken();
		  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
		}

		if (isset($_SESSION['token'])) {
		  $client->setAccessToken($_SESSION['token']);
		}

		if ($client->getAccessToken()) {
			$calList = $cal->calendarList->listCalendarList();
//			print_r($calList);
//			exit;
			$rightNow = date('c');
			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $rightNow);
			$calList2 = $cal->events->listEvents('windowrnr.com_c7df92ao3vvg02n2kh52b81tn4@group.calendar.google.com', $params);
			//print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";
			//print "<h1>Calendar List2</h1><pre>" . print_r($calList2, true) . "</pre>";
			$events = array();
			foreach ($calList2['items'] as $event)
			{
				$events[] = array(
					"title" => $event['summary'],
					"start" => $event['start']['dateTime'],
					"end" => $event['end']['dateTime'],
					"url" => $event['htmlLink'],
					//"url" => 'http://www.google.com',
					"allDay" => false
//					"location" => $event['location'],
//					"description" => $event['description']
				);
			}

			$_SESSION['token'] = $client->getAccessToken();
			return $events;
		} else {
		  $authUrl = $client->createAuthUrl();
		  print "<a class='login' href='$authUrl'>Connect Me!</a>";
		}
	}

	public function getContracts()
	{
		return View::make('customers.contracts')
			->with('customers', Customer::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	 
	public function schedule()
	{
//		return View::make('customers.index#tab2');
		return Redirect::to('customers#tab2');
	}
	
	public function store()
	{
		$customer = new customer;
		$customer->f_name = Input::get('f_name');
		$customer->l_name = Input::get('l_name');
		$customer->phone = Input::get('phone');
		$customer->email = Input::get('email');
		
		$customer->save();
		
		$job = new job;
		$job->customer_id = $customer->id;
		$job->status = '1';
		$job->archive = '0';
		$job->address = Input::get('address');
		$job->city = Input::get('city');
		$job->zip = Input::get('zip');
		$job->built = Input::get('built');
		$job->symptoms = Input::get('symptoms');
		$job->address = Input::get('address');
		$job->lead_source = Input::get('lead_source');
		$array = Input::get('type');
		
	
		if(count($array) > 0) {
			$job->type = $array[0];
			$i = 1;
			for($i, $n = count($array); $i < $n; $i++) {
				$job->type .= ', '.$array[$i];
			}
		}
		$job->save();
	
		$user = Sentry::getUser();
		$timeDate = DB::table('jobs')->where('id', $job->id)->pluck('created_at');
//var_dump($timeDate);
//	exit;
		
		$noteAdd = new note;
		$noteAdd->job_id = $job->id;
		$noteAdd->user_id = $user->id;
		$noteAdd->note = 'Lead created on '.date("n/j/y (g:ia)", strtotime($timeDate)).' by: '.$user->first_name;
		$noteAdd->save();	
			
		$note = new note;
		$note->job_id = $job->id;
		$note->user_id = $user->id;
//var_dump($user->id);
//exit;
		$note->note = Input::get('note');
		
		$note->save();
		
		Session::flash('success', 'Customer added.');
		return Redirect::to('customers');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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