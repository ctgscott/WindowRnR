<?php

class JobsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('jobs')->truncate();

		$jobs = array(
			['customer_id' => '1', 
			'status' => '1',
			'archive' => '0',
			'created_by'=> 'Scott',
			'address' => '2544 3rd Street',
			'city' => 'Santa Monica',
			'zip' => '90405',
			'lat' => '34.002987',
			'lng' => '-118.482479',
			'built' => '1912',
			'type' => 'Wood DH, Wood CM',
			'lead_source' => 'Google',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime,
			'lead_scheduled' => null,
			'job_scheduled' => null,
			'job_completed' => null],

			['customer_id' => '2', 
			'status' => '1',
			'archive' => '0',
			'created_by'=> 'Scott',
			'address' => '3377 Cerritos Ave',
			'city' => 'Los Alamitos',
			'zip' => '90720',
			'lat' => '33.8106171',
			'lng' => '-118.0731239',
			'built' => '1932',
			'type' => 'Wood DH, Wood CM',
			'lead_source' => 'Angies',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime,
			'lead_scheduled' => null,
			'job_scheduled' => null,
			'job_completed' => null]
		);

		// Uncomment the below to run the seeder
		DB::table('jobs')->insert($jobs);
	}

}
