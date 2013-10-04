<?php


class JobsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
	
	public static function updateStatus($id, $status)
	{
		/* states:
		* 1 = Lead created
		* 2 = Lead Scheduled
		* 3 = Quote created
		* 4 = Job scheduled
		* 5 = Sales receipt created/Job complete
		*/
		
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
				DB::table('jobs')
					->where('id', $id)
					->update(array('status' => $status));
				
				$jobStatus = DB::table('jobs')
					->join('status', 'jobs.status', '=', 'status.status_id')
					->where('status.status_id', '=', $status)
					->pluck('status.status');
				$job_id = $id;
				$user_id = Sentry::getUser()->id;
				$note = 'Lead status changed to: '.$jobStatus;
				$result = NotesController::create($job_id, $user_id, $note);
				
				return $result;
			}
			catch (Exception $e) {
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