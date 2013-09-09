<?php

class ServicesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('services')->truncate();

		$services = array(
			['title' => 'DH2-RnR',
			'summary' => 'Double-Hung (Dual Balancer), Repair & Recuperate',
			'description' => 'Restore original function to Double-hung window with dual balancers, such that it opens and closes easily, seals and locks properly',
			'price' => '295.00',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['title' => 'DH-RnR',
			'summary' => 'Double-Hung (Pulley & Counter-weights), Repair & Recuperate',
			'description' => 'Restore original function to Double-hung window with dual balancers, such that it opens and closes easily, seals and locks properly',
			'price' => '275.00',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],
		);

		// Uncomment the below to run the seeder
		DB::table('services')->insert($services);
	}

}
