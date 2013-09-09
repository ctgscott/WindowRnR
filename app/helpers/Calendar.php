<?php

Class Calendar {	
	public static function getEvents($date)
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
		$client->setRedirectUri('http://Localhost:8000/customers/schedule/2');
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
			$rightNow = $date;
			$params = array('singleEvents' => 'true', 'orderBy' => 'startTime', 'timeMin' => $rightNow);
			$calList2 = $cal->events->listEvents('primary', $params);
			//print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";
			print "<h1>Calendar List2</h1><pre>" . print_r($calList2, true) . "</pre>";
			$events = array();
			foreach ($calList2['items'] as $event)
			{
				$events['events'][] = array(
					"title" => $event['summary'],
					"start" => $event['start']['dateTime'],
					"end" => $event['end']['dateTime'],
					"url" => $event['htmlLink'],
					"location" => $event['location'],
					"description" => $event['description']
				);
			}

			$_SESSION['token'] = $client->getAccessToken();
			print_r(json_encode($events));
			exit;
			return json_encode($events);
		} else {
		  $authUrl = $client->createAuthUrl();
		  print "<a class='login' href='$authUrl'>Connect Me!</a>";
		}
	}
}