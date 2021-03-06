<?php



class CustomersController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);


		if ( ! Sentry::check())
		{
			// User is not logged in, or is not activated
		    Session::flash('error', 'There was a problem accessing your account.');
			return Redirect::to('/');
		}
		else
		{
			// User is logged in
			require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
			require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';
			$client = new Google_Client();

			
			if (isset($_GET['code'])) {
				$client->authenticate($_GET['code']);
				$_SESSION['token'] = $client->getAccessToken();

				return Redirect::to('/customers');
			}

			if (isset($_SESSION['token'])) {
				$client->setAccessToken($_SESSION['token']);

				try 
				{
					$leadCheck = file_get_contents('http://www.windowrnr.com/LeadCheck.php');
					if (is_numeric($leadCheck)) {
						if ($leadCheck == '0') {
							Session::flash('info', 'No new leads have been received from our Web Contact Form.');
						} else if ($leadCheck > 0) {
							Session::flash('success', $leadCheck.' new Contact Form leads were added');
						}
					} else {
						Session::flash('error', 'Lead check failed with the following error: <br/>'.$leadCheck);
					}
				}
				catch (Exception $e) {
					Session::flash('error', 'There was a problem: '.$e);
					return $e;
				}

				try 
				{
					$results['customers'] = DB::table('jobs')
						->join('customers', 'jobs.customer_id', '=', 'customers.id')
						->select(
							'customers.id as customer_id', 
							'customers.l_name as customer_lname', 
							'customers.f_name as customer_fname', 
							'customers.phone as customer_phone', 
							'customers.alt_phone as customer_altphone', 
							'customers.email as customer_email', 
							'jobs.id as job_id', 
							'jobs.created_at as job_created_at', 
							'jobs.created_by as job_created_by', 
							'jobs.address as job_address', 
							'jobs.city as job_city', 
							'jobs.zip as job_zip', 
							'jobs.built as job_house_built'
						)
						->where('jobs.status', '=', 1)
						->where('jobs.archive', '=', 0)
						->get();
					$firephp->log($results, 'Results');

					return View::make('customers.index')->with($results);
				}
				catch (Exception $e) {
					Session::flash('error', 'There was a problem: '.$e);
					return $e;
				}
			}
		}
	}

	public function leadByJobID($jobID)
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		if ( ! Sentry::check())
		{
			// User is not logged in, or is not activated
			if (isset($_SESSION['token'])) {
				unset($_SESSION['token']);
			}
			Session::flash('error', 'There was a problem accessing your account.');
			return Redirect::to('/');
		}
		else
		{
			$results['customers'] = DB::table('jobs')
				->join('customers', 'jobs.customer_id', '=', 'customers.id')
				->select(
					'customers.id as customer_id', 
					'customers.l_name as customer_lname', 
					'customers.f_name as customer_fname', 
					'customers.phone as customer_phone', 
					'customers.alt_phone as customer_altphone', 
					'customers.email as customer_email', 
					'jobs.id as job_id', 
					'jobs.created_at as job_created_at', 
					'jobs.created_by as job_created_by', 
					'jobs.address as job_address', 
					'jobs.city as job_city', 
					'jobs.zip as job_zip', 
					'jobs.built as job_house_built'
				)
				->where('jobs.status', '=', 1)
				->where('jobs.archive', '=', 0)
				->where('jobs.id', '=', $jobID)
				->get();

				$firephp->log($results, 'Results');
				
			return $results;
		}
	}
	
	public static function leadByCustID($custID)
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$firephp->log($custID, '$id2');
	
		if ( ! Sentry::check())
		{
			// User is not logged in, or is not activated
			if (isset($_SESSION['token'])) {
				unset($_SESSION['token']);
			}
			Session::flash('error', 'There was a problem accessing your account.');
			return Redirect::to('/');
		}
		else
		{
			try 
			{
				$results = DB::table('customers')
					->select(
						'customers.id as customer_id', 
						'customers.l_name as customer_lname', 
						'customers.f_name as customer_fname', 
						'customers.phone as customer_phone', 
						'customers.alt_phone as customer_altphone', 
						'customers.email as customer_email', 
						'customers.billing_address as billing_address',
						'customers.billing_city as billing_city',
						'customers.billing_state as billing_state',
						'customers.billing_zip as billing_zip'
					)
					->where('customers.id', '=', $custID)
					->get();
				
				return $results;
			}
			catch (Exception $e) {
				Session::flash('error', 'There was a problem: '.$e);
				return $e;
			}
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
			$results = array("test", "stuff");
			return View::make('customers.schedule')->with($results);
			//return Redirect::to('customers/schedule')->with($results);
		}
	}

	public static function getDetailID($id)
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		if ( ! Sentry::check())
		{
			// User is not logged in, or is not activated
			if (isset($_SESSION['token'])) {
				unset($_SESSION['token']);
			}
			Session::flash('error', 'There was a problem accessing your account.');
			return Redirect::to('/');
		}
		else
		{
			try {
				$results['jobs'] = DB::table('jobs')->where('id', $id)->get();
				$results['custDetail'] = DB::table('customers')->where('id', $results['jobs']['0']->customer_id)->get();
				$results['window_totals'] = Window_totalsController::totalsByJobID($id);

				foreach ($results['jobs'] as $job) {
					$job->notes = NotesController::notesByJobID($job->id);
				};

				$firephp->log($results, '$resultstotal');
	
				return View::make('customers.edit')->with($results);
			}
			catch (Exception $e) {
				$firephp->log($e, 'catch');
				
				Session::flash('error', 'There was a problem: '.$e);
				return $e;
			}
		}
	}
	
	public function autocomplete()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$term = Input::get('term');
		$data = array();

		$query = DB::select("SELECT * FROM customers WHERE MATCH(l_name) AGAINST('+".$term."*' IN BOOLEAN MODE) LIMIT 5");

		$firephp->log($query, 'query');

		foreach ($query as $results => $customer) {
			$data[] = array(
				'id' => $customer->id,
				'value' => $customer->l_name
			);
		}
		return json_encode($data);
	}
	
	public function typeahead()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$term = Input::get('term');
		$data = array();

		$query = DB::select("SELECT id, l_name, f_name, billing_address, billing_city, phone, email FROM customers WHERE MATCH(l_name) AGAINST('+".$term."*' IN BOOLEAN MODE) LIMIT 5");

		//$firephp->log($query, 'query');

		foreach ($query as $results => $customer) {
			$data[] = array(
				'id' => $customer->id,
				'value' => $customer->l_name,
				'l_name' => $customer->l_name,
				'f_name' => $customer->f_name,
				'address' => $customer->billing_address,
				'city' => $customer->billing_city,
				'phone' => $customer->phone,
				'email' => $customer->email,
			);
		}
		$test = json_encode($data); 

		$firephp->log($test, 'test');

		return json_encode($data);
	}

	public function getScheduleID($id)
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		if ( ! Sentry::check())
		{
			// User is not logged in, or is not activated
			if (isset($_SESSION['token'])) {
				unset($_SESSION['token']);
			}
			Session::flash('error', 'There was a problem accessing your account.');
			return Redirect::to('/');
		}
		else
		{
			// User is logged in
			$results['lead'] = DB::table('jobs')
				->join('customers', 'jobs.customer_id', '=', 'customers.id')
//				->join('notes', 'jobs.id', '=', 'notes.job_id')
				->select('customers.id as customer_id', 'customers.l_name as customer_lname', 'customers.f_name as customer_fname', 'customers.phone as customer_phone', 'customers.alt_phone as customer_altphone', 'customers.email as customer_email', 'jobs.id as job_id', 'jobs.created_at as job_created_at', 'jobs.created_by as job_created_by', 'jobs.address as job_address', 'jobs.city as job_city', 'jobs.zip as job_zip', 'jobs.built as house_built')
				->where('jobs.id', '=', $id)
				->get();

			$results['notes'] = DB::table('lead')
				->where('user_id', '=', $id)
				->get();
				
			$ts = strtotime("now");
			$init = (date('w', $ts) == 1) ? strtotime('midnight') : strtotime('last Monday', $ts);
			$monday = date('c', $init);
			$mondayStart = $init;
			$mondayEnd = $mondayStart+86399;
			$tuesdayStart = $mondayEnd+1;
			$tuesdayEnd = $tuesdayStart+86399;
			$wednesdayStart = $tuesdayEnd+1;
			$wednesdayEnd = $wednesdayStart+86399;
			$thursdayStart = $wednesdayEnd+1;
			$thursdayEnd = $thursdayStart+86399;
			$fridayStart = $thursdayEnd+1;
			$fridayEnd = $fridayStart+86399;

			$salesChecks = ProfilesController::getSalesCheckBox();
			$firephp->log($salesChecks, '$salesChecks = ');
			
			$firephp->log(date("H:i:s", microtime(true)), 'Time Check4');
			
/*			$results['map1'] = EventsController::getCalEvents($mondayStart, $mondayEnd);
			$results['map2'] = EventsController::getCalEvents($tuesdayStart, $tuesdayEnd);
			$results['map3'] = EventsController::getCalEvents($wednesdayStart, $wednesdayEnd);
			$results['map4'] = EventsController::getCalEvents($thursdayStart, $thursdayEnd);
			$results['map5'] = EventsController::getCalEvents($fridayStart, $fridayEnd);
*/			$firephp->log(date("H:i:s", microtime(true)), 'Time Check5');
			
			$results['profiles'] = UserController::getSalesProfiles();
			
			$firephp->log($results, 'getScheduleID($id)');
			$firephp->log(date("H:i:s", microtime(true)), 'Time Check6');
			return View::make('customers.schedule')->with($results);
		}
	}

	public static function EstimateSchedule()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';

		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$client = new Google_Client();
		$client->setApplicationName("WindowRnR");
		$cal = new Google_CalendarService($client);

		$start = date('c',$_GET['start']);
		$end = date('c',$_GET['end']);
		
		if (isset($_SESSION['token'])) {
			$client->setAccessToken($_SESSION['token']);
		}

		if ($client->getAccessToken()) {
			$rightNow = date('c');
			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $start, 'timeMax' => $end);
			$calList2 = $cal->events->listEvents('windowrnr.com_g67gtb3doc8ehsdaffpe1idaq4@group.calendar.google.com', $params);
			$firephp->log($calList2, 'calList2');

			$events = array();
			foreach ($calList2['items'] as $event)
			{
				if(isset($event['start']['dateTime'])) {
					$eventStart = $event['start']['dateTime'];
					$eventEnd = $event['end']['dateTime'];
					$allDay = false;
				}else{
					$eventStart = $event['start']['date'];
					$eventEnd = date('Y-m-d', strtotime($event['end']['date'])-1);
					$allDay = true;
				}

				if(!isset($event['description'])) {
					$event['description'] = null;
				}
			
				$events[] = array(
					"title" => $event['summary'],
					"start" => $eventStart,
					"end" => $eventEnd,
					"url" => $event['htmlLink'],
					"allDay" => $allDay,
					"description" => $event['description'],
					"location" => $event['location'],
				);
			}
			$firephp->log($events, 'estimateSchedule($events)');
			return $events;
		}
	}

	public static function EstimateSchedule2()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';

		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$client = new Google_Client();
		$client->setApplicationName("WindowRnR");
		$cal = new Google_CalendarService($client);

		$start = date('c',$_GET['start']);
		$end = date('c',$_GET['end']);
		
		if (isset($_SESSION['token'])) {
			$client->setAccessToken($_SESSION['token']);
		}

		if ($client->getAccessToken()) {
			$rightNow = date('c');
			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $start, 'timeMax' => $end);
			$calList = $cal->events->listEvents('windowrnr.com_c7df92ao3vvg02n2kh52b81tn4@group.calendar.google.com', $params);
			$firephp->log($calList, 'calList');

			$events = array();
			foreach ($calList['items'] as $event)
			{
				if(isset($event['start']['dateTime'])) {
					$eventStart = $event['start']['dateTime'];
					$eventEnd = $event['end']['dateTime'];
					$allDay = false;
				}else{
					$eventStart = $event['start']['date'];
					$eventEnd = date('Y-m-d', strtotime($event['end']['date'])-1);
					$allDay = true;
				}

				if(!isset($event['description'])) {
					$event['description'] = null;
				}
			
				$events[] = array(
					"title" => $event['summary'],
					"start" => $eventStart,
					"end" => $eventEnd,
					"url" => $event['htmlLink'],
					"allDay" => $allDay,
					"description" => $event['description'],
					"location" => $event['location'],
				);
			}
			$firephp->log($events, 'estimateSchedule($events)');
			return $events;
	/*	require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';
		
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$start = date('c',$_GET['start']);
		
		$client = new Google_Client();
		$client->setApplicationName("Google Calendar PHP Starter Application");

		$client->setRedirectUri('http://Localhost:8000/customers/schedule');
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
			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $start);
			$calList2 = $cal->events->listEvents('windowrnr.com_c7df92ao3vvg02n2kh52b81tn4@group.calendar.google.com', $params);
			$events = array();
			foreach ($calList2['items'] as $event)
			{
				if(!isset($event['description'])) {
					$event['description'] = null;
				}

				$events[] = array(
					"title" => $event['summary'],
					"start" => $event['start']['dateTime'],
					"end" => $event['end']['dateTime'],
					"url" => $event['htmlLink'],
					"allDay" => false,
					"location" => $event['location'],
					"description" => $event['description']
				);
			}

			$_SESSION['token'] = $client->getAccessToken();
		$firephp->log($events, 'estimateSchedule2($events)');

			return $events;
		} else {
			$authUrl = $client->createAuthUrl();
			echo '<script type="text/javascript">
				window.location.href="'.$authUrl.'";
				</script>';
		$firephp->log($_SESSION, 'EstimateSchedule2, $_SESSION #2)');
*/		}
	}
	
	public static function EstSchedByIDByDay($calendar, $monday)
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$client = new Google_Client();
		$client->setApplicationName("Window R & R");
		$cal = new Google_CalendarService($client);

		if (isset($_SESSION['token'])) {
			$client->setAccessToken($_SESSION['token']);
		}

		if ($client->getAccessToken()) {

			$ts = strtotime("now");
			$init = (date('w', $ts) == 1) ? $ts : strtotime('last Monday', $ts);
			$start_date = date('c', $init);
			$end_date = date('c', strtotime('this Saturday', $init));			$events = array();

			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $start_date, 'timeMax' => $end_date);

			foreach ($calendar as $calUser) 
			{
//				$firephp->log($calUser, '$calUser = ');
				$calList = $cal->events->listEvents($calUser['id'], $params);
				$firephp->log($calList, 'EstSchedByIDByDay - calList');

					
				foreach ($calList['items'] as $event)
				{
					if(isset($event['start']['dateTime'])) {
						$n = date('w', strtotime($event['start']['dateTime']));
						$start = date('w', strtotime($event['start']['dateTime']));
						$end = date('w', strtotime($event['end']['dateTime']));
					}else{
						$n = date('w', strtotime($event['start']['date']));
						$start = date('w', strtotime($event['start']['date']));
						$end = date('w', strtotime($event['end']['date']));
					}
//					$firephp->log($event['start']['dateTime'], 'EstSchedByIDByDay - dateTime = ');
//					$firephp->log($n, 'EstSchedByIDByDay - $n = ');
					
					
	/*				if(!isset($event['description'])) {
						$events[$name][]['descriptions'] = 'none';
					}
					if(isset($event['start']['dateTime'])) {
						$events[$name][]['allDay'] = false;
						$events[$name][]['start'] = $event['start']['dateTime'];
						$events[$name][]['end'] = $event['end']['dateTime'];
					} else {
						$events[$name][]['allDay'] = true;
						$events[$name][]['start'] = $event['start']['date'];
						$events[$name][]['end'] = $event['end']['date'];
					}
					
	*/				if(!isset($event['description'])) {
						$event['description'] = null;
					}
					
					$events[$n][$calUser['name']][] = array(
						"title" => $event['summary'],
						"start" => $start,
						"end" => $end,
						"url" => $event['htmlLink'],
						"allDay" => false,
						"content" => $event['location'],
						"description" => $event['description'],
						"location" => $event['location'],
					);
				}
				if(!isset($events[1])) {
					$events[1][$calUser['name']] = null;
				}
				if(!isset($events[2])) {
					$events[2][$calUser['name']] = null;
				}
				if(!isset($events[3])) {
					$events[3][$calUser['name']] = null;
				}
				if(!isset($events[4])) {
					$events[4][$calUser['name']] = null;
				}
				if(!isset($events[5])) {
					$events[5][$calUser['name']] = null;
				}
			}

//			$firephp->log($events, 'EstSchedByIDByDay = ');
			return $events;
		}
	}

	public function postGoogleInsert()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/Google_Client.php';
		require_once $_SERVER['DOCUMENT_ROOT'].'/google-api-php-client/src/contrib/Google_CalendarService.php';

		$client = new Google_Client();
		$client->setApplicationName("WindowRnR");

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

			$calendarID = $_POST['calendarID'];
			$summary = $_POST['summary'];
			$location = $_POST['location'];
			$job_id = $_POST['job_id'];
			$start = substr($_POST['start'], 0, 33);
			$start = strtotime($start);
			$start = date('c', $start);
			$end = substr($_POST['end'], 0, 33);
			$end = strtotime($end);
			$end = date('c', $end);
			$description = "Job ID: ".$_POST['job_id'].", ";
			$description .= "<br/>".$_POST['description'];
			$event = new Google_Event();
			$event->setSummary($summary);
			$event->setLocation($location);
			$event->setDescription($description);
			$eventStart = new Google_EventDateTime();
			$eventStart->setDateTime($start);
			$event->setStart($eventStart);
			$eventEnd = new Google_EventDateTime();
			$eventEnd->setDateTime($end);
			$event->setEnd($eventEnd);

			$createdEvent = $cal->events->insert($calendarID, $event);

			$statusResult[0] = AppointmentsController::insert($job_id, 'x', $start, $end, 'x', 'x');
			$statusResult[1] = JobsController::updateStatus($job_id, 2);

			if ($statusResult[0] == 'Success' && $statusResult[1] == 'Success') {
				Session::flash('success', 'Lead Scheduled');
				return $createdEvent['id'];
			} else {
				Session::flash("Failure", "Status updated failed with Appointment inserts returning".$statusResult[0].", and Job inserts returning: ".$statusResult[1]);
			}
		
//		$_SESSION['token'] = $client->getAccessToken();
		} else {
		  $authUrl = $client->createAuthUrl();
	//	  print "<a class='login' href='$authUrl'>Connect Me!</a>";
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
	
	public function newLead()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

//		$firephp->log($_POST, '$_POST');
		
		try {
			$results = CustomersController::store();

//			echo var_dump($_POST);
//			exit;

			if (is_numeric($results)) {
				Session::flash('success', 'Lead #'.$results.' added.');
				if (isset($_POST['scheduleNewLead'])) {
					return Redirect::to('customers/schedule/'.$results);
				} else {
					return Redirect::to('customers');
				}
			} else {
				Session::flash('error', 'Error occurred: '.$results);
				return Redirect::to('customers');
			}
		}
		catch (Exception $e) {
			Session::flash('error', 'There was a problem: '.$e);

			return Redirect::to('customers');
		}
	}
	
	public function store()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		$firephp->log($_POST, '$_POST');

		try {

			$now = date("Y-m-d H:i:s");
		
			$customer = new customer;
			$customer->f_name = Input::get('f_name');
			$customer->l_name = Input::get('l_name');
			$customer->phone = Input::get('phone');
			$customer->email = Input::get('email');
			$customer->created_at = $now;
			$customer->updated_at = $now;
			
			$customer->save();
			
			$job = new job;
			$job->customer_id = $customer->id;
			$job->status = '1';
			$job->archive = '0';
			$job->address = Input::get('address');
			$job->city = Input::get('city');
			$job->zip = Input::get('zip');
			$job->built = Input::get('built');
			$job->address = Input::get('address');
			$job->created_at = $now;
			$job->updated_at = $now;
			$array = Input::get('lead_source');
			if(count($array) > 0) {
				$job->lead_source = $array[0];
				$i = 1;
				for($i, $n = count($array); $i < $n; $i++) {
					$job->lead_source .= ', '.$array[$i];
				}
			}

			$job->save();
			$resultID = $job->id;
			
			$user = Sentry::getUser();
			$timeDate = DB::table('jobs')->where('id', $job->id)->pluck('created_at');
			
			$noteAdd = new note;
			$noteAdd->job_id = $job->id;
			$noteAdd->user_id = $user->id;
			$noteAdd->note = 'Lead created.';
			$noteAdd->created_at = $now;
			$noteAdd->updated_at = $now;
			$noteAdd->save();	
				
			$note = new note;
			$note->job_id = $job->id;
			$note->user_id = $user->id;
			$note->note = Input::get('note');
			$note->created_at = $now;
			$note->updated_at = $now;
			$note->save();
			
			if (isset($_POST['qty1'])) {
				$pos = array();
				foreach($_POST as $key => $value) {
					if (strpos($key, "qty") !== false) {
						$pos[] = strpos($key , "qty");
					}
				}
				$num = count($pos);
//				$firephp->log(print_r($pos), '$pos');
//				$firephp->log($num, '$num');
				$i = 0;
				foreach($pos as $qty) {
					$i++;
//					$firephp->log($i, '$i');
					if (isset($_POST['qty'.$i])) {
						$style = new Window_total;
						$style->job_id = $job->id;
						$style->qty = Input::get('qty'.$i);
						$style->material = Input::get('material'.$i);
						$style->style = Input::get('style'.$i);
						$style->save();

//						$firephp->log(var_dump($style), '$style');
					}
				}
			}
			return $resultID;
		}
		catch (Exception $e) {
			Session::flash('error', 'There was a problem: '.$e);
			echo $e;
			return $e;
		}
		
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
		$results = CustomersController::leadByJobID($id);
		return View::make('customers.edit')->with($results);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		require_once $_SERVER['DOCUMENT_ROOT'].'/FirePHPCore/FirePHP.class.php';	
		ob_start();
		$firephp = FirePHP::getInstance(true);

		if ( ! Sentry::check())
		{
			// User is not logged in, or is not activated
			if (isset($_SESSION['token'])) {
				unset($_SESSION['token']);
			}
			Session::flash('error', 'There was a problem accessing your account.');
			return Redirect::to('/');
		}
		else
		{
			try {
				$now = date("Y-m-d H:i:s");

				$custID = Input::get('custID');
				$custUpdate = array(
					'f_name' => Input::get('f_name'),
					'l_name' => Input::get('l_name'),
					'phone' => Input::get('phone'),
					'email' => Input::get('email'),
					'alt_phone' => Input::get('alt_phone'),
					'billing_address' => Input::get('billing_address'),
					'billing_city' => Input::get('billing_city'),
					'billing_zip' => Input::get('billing_zip'),
					'updated_at' => $now);
						
				$jobID = Input::get('jobID');
				$jobUpdate = array(
					'address' => Input::get('address'),
					'city' => Input::get('city'),
					'state' => Input::get('state'),
					'zip' => Input::get('zip'),
					'built' => Input::get('built'),
					'lead_source' => Input::get('lead_source'),
					'updated_at' => $now);
				$array = Input::get('lead_source');
				if(count($array) > 0) {
					$jobUpdate['lead_source'] = $array[0];
					$i = 1;
					for($i, $n = count($array); $i < $n; $i++) {
						$jobUpdate['lead_source'] .= ', '.$array[$i];
					}
//				$firephp->log(print_r($jobUpdate), '$jobUpdate');
//				exit;
				}

				
				$pos = array();
				foreach($_POST as $key => $value) {
					if (strpos($key, "qty") !== false) {
						$pos[] = strpos($key , "qty");
					}
				}
				$num = count($pos);
//				$firephp->log(print_r($pos), '$pos');
//				$firephp->log($num, '$num');
				$i = 0;
				foreach($pos as $qty) {
					$i++;
					$windowTotalID = Input::get('windowTotalID'.$i);
//					$firephp->log($i, '$i');
					if (isset($_POST['qty'.$i])) {
						$material = Input::get('material'.$i);
						$style = Input::get('style'.$i);
						$qty = Input::get('qty'.$i);
						$windowTotalUpdate = array(
							'qty' => $qty,
							'material' => $material,
							'style' => $style,
							'updated_at' => $now
						);
						if (isset($_POST['windowTotalID'.$i])) {
							DB::table('window_totals')
								->where('id', $windowTotalID)
								->update($windowTotalUpdate);
						} else {
							DB::table('window_totals')->insert(array(
								'job_id' => $jobID,
								'qty' => $qty,
								'material' => $material,
								'style' => $style,
								'updated_at' => $now,
								'created_at' => $now
							));
						}

					
//						$firephp->log(var_dump($style), '$style');
					}
				}
			

/*				echo "<pre>custUpdate = ".var_dump($custUpdate)."</pre>";
				echo "</br></br>";
				echo "<pre>jobUpdate = ".var_dump($jobUpdate)."</pre>";
				echo "</br></br>";
				echo "Cust ID = ".$custID;
				echo "</br></br>";
				echo "Job ID = ".$jobID;
				echo "</br></br>";
				echo "<pre>".var_dump($_POST)."</pre>";
*/				
				DB::table('customers')
					->where('id', $custID)
					->update($custUpdate);

				DB::table('jobs')
					->where('id', $jobID)
					->update($jobUpdate);
					
				$userID = Sentry::getUser();
				$note = "Lead detail updated";
				$noteResult = NotesController::create($jobID, $userID, $note);
				
				$newNote = Input::get('newNote');
				if ($newNote != '') {
					$noteResult2 = NotesController::create($jobID, $userID, $newNote);
					if ($noteResult && $noteResult2 == 'Success') {
						Session::flash('success', 'Lead updated successfully.1');
					} else {
						Session::flash('error', 'There was a problem with the lead update.');
					}
				} else {
					if ($noteResult == 'Success') {
						Session::flash('success', 'Lead updated successfully.2');
					} else {
						Session::flash('error', 'There was a problem with the lead update.');
					}
				}
				echo $noteResult."</br></br>";
				echo "<pre>".var_dump($_SESSION)."</pre>";
			}
			catch (Exception $e) {
				Session::flash('error', 'There was a problem: '.$e);
				return $e;
			}
			return Redirect::to('customers');
		}

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