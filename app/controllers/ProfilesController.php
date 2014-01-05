<?php

class ProfilesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('profiles.index');
	}

	/**
	 * Return the avatar image name for the give id.
	 *
	 * @return Response
	 */
	public static function getAvatar($id)
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
			try {
				$results = DB::table('profiles')
					->where('id', '=', $id)
					->pluck('avatar');
				$firephp->log($results, 'ProfilesController $results = ');
				return $results;
			}
			catch (Exception $e) {
				return $e;
			}
		}
	}
	
	public static function saveAvatar($id, $avatar)
	{
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
			try {
				$results = DB::table('profiles')
					->where('id', $id)
					->update(array('avatar' => $avatar));
				return $results;
			}
			catch (Exception $e) {
				return $e;
			}
		}
	}

	/**
	 * Return the google_id for the given id.
	 *
	 * @return Response
	 */
	public static function getGoogleID($id)
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
			try {
				$results = DB::table('profiles')
					->where('id', '=', $id)
					->pluck('google_id');
				$firephp->log($results, 'ProfilesController $results = ');
				return $results;
			}
			catch (Exception $e) {
				return $e;
			}
		}
	}

	/**
	 * Return the avatar image name for the give id.
	 *
	 * @return Response
	 */
	public static function getGoogleCalendarID($id)
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
			try {
				$results = DB::table('profiles')
					->where('id', '=', $id)
					->pluck('google_calendar_id');
				$firephp->log($results, 'ProfilesController $results = ');
				return $results;
			}
			catch (Exception $e) {
				return $e;
			}
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('profiles.create');
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
        return View::make('profiles.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('profiles.edit');
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
