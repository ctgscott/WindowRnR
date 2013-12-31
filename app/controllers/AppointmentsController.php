<?php

class AppointmentsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('appointments.index');
	}
	
	/**
	* $cust_id is optional
	* $allDay is optional, if absent defaults to 'no'
	*/
	public static function insert($job_id, $cust_id, $start, $end, $allDay, $url)
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
				DB::table('appointments')
					->insert(array(
						'job_id' => $job_id, 
						'cust_id' => $cust_id, 
						'appt_start' => $start, 
						'appt_end' => $end, 
						'all_day' => $allDay, 
						'appt_url' => $url, 
						'created_at' => $now
					));
				return 'Success';
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
        return View::make('appointments.create');
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
        return View::make('appointments.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('appointments.edit');
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
