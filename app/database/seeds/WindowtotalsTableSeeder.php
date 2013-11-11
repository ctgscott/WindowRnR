<?php

class WindowtotalsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('window_totals')->truncate();

		$window_totals = array(
			['job_id' => '1', 
			'qty' => '5',
			'material' => 'wood',
			'style' => 'double hung'],
			
			['job_id' => '1', 
			'qty' => '2',
			'material' => 'wood',
			'style' => 'casement'],
			
			['job_id' => '2', 
			'qty' => '8',
			'material' => 'wood',
			'style' => 'double hung'],
		);

		// Uncomment the below to run the seeder
		DB::table('window_totals')->insert($window_totals);
	}

}
