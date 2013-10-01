<?php

class StatusTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('status')->truncate();

		$status = array(
			['status_id' => 1,
			'status' => 'Lead Created'],
			
			['status_id' => 2,
			'status' => 'Lead Scheduled'],
			
			['status_id' => 3,
			'status' => 'Quote Created'],

			['status_id' => 4,
			'status' => 'Job Scheduled'],

			['status_id' => 5,
			'status' => 'Sales Receipt Created/Job Complete'],
		);

		// Uncomment the below to run the seeder
		DB::table('status')->insert($status);
	}

}
