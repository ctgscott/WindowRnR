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
		try {
			DB::table('jobs')
				->where('id', $id)
				->update(array('status' => $status));
			
			$user = Sentry::getUser();
			$jobStatus = DB::table('jobs')
				->join('status', 'jobs.status', '=', 'status.status_id')
				->select('status.status')
				->where('status.status_id', '=', $status)
				->get();
				
			$noteAdd = new note;
			$noteAdd->job_id = $id;
			$noteAdd->user_id = $user->id;
			$noteAdd->note = 'Status changed to "'.$jobStatus.'" on '.date("n/j/Y (g:ia)", time()).' by: '.$user->first_name;
			$noteAdd->save();	
			
			return 'Success';
		}
		
		catch (Exception $e) {
			return $e;
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