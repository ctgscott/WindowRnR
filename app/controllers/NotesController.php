<?php

class NotesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		echo "Hello World";
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public static function create($job_id, $user_id, $note)
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
				$now = date("Y-m-d H:i:s");
				DB::table('notes')
					->insert(array('job_id' => $job_id, 'user_id' => $user_id, 'note' => $note, 'created_at' => $now));
				return 'Success';
			}
			catch (Exception $e) {
				return $e;
			}
		}
	}

	public static function notesByJobID($job_id)
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
				$results = DB::table('notes')
					->select('user_id', 'note', 'created_at')
					->where('job_id', '=', $job_id)
					->get();
				return $results;
			}
			catch (Exception $e) {
				return $e;
			}
		}
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