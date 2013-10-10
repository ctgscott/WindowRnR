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
	
	public static function jobDetailByCustID($custID, $status, $archive)
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
			try 
			{
				$results = DB::table('jobs')
					->join('notes', 'notes.job_id', '=', 'jobs.id')
					->select(
						'jobs.id as job_id', 
						'jobs.created_at as job_created_at', 
						'jobs.created_by as job_created_by', 
						'jobs.address as job_address', 
						'jobs.city as job_city', 
						'jobs.state as job_state', 
						'jobs.zip as job_zip', 
						'jobs.built as job_house_built',
						'jobs.type as job_type',
						'jobs.symptoms as job_symptoms',
						'jobs.lead_source as job_lead_source',
						'notes.user_id as notes_user_id',
						'notes.note as notes_note',
						'notes.created_at'
					)
					->where('jobs.status', '=', $status)
					->where('jobs.archive', '=', $archive)
					->where('jobs.customer_id', '=', $custID)
					->get();
					
				return $results;
			}
			catch (Exception $e) {
				Session::flash('error', 'There was a problem: '.$e);
				return $e;
			}
		}
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