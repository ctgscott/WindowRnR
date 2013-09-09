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
			'built' => '1912',
			'type' => 'Wood DH, Wood CM',
			'symptoms' => 'DHs need TLC, CMs need weather stripping.',
			'lead_source' => 'Google',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['customer_id' => '2', 
			'status' => '1',
			'archive' => '0',
			'created_by'=> 'Scott',
			'address' => '3377 Cerritos Ave',
			'city' => 'Los Alamitos',
			'zip' => '90720',
			'built' => '1932',
			'type' => 'Wood DH, Wood CM',
			'symptoms' => 'DHs need TLC, CMs need weather stripping.',
			'lead_source' => 'Angies',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],
		);

		// Uncomment the below to run the seeder
		DB::table('jobs')->insert($jobs);
	}

}
