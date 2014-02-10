<?php

class ProfilesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('profiles')->truncate();

		$profiles = array(
			['user_id' => '1',
			'google_id' => 'scott@windowrnr.com',
			'google_calendar_id' => 'scott@windowrnr.com',
			'sales_check' => 1,
			'first_name' => 'Scott',
			'avatar' => 'WinPin7.png',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['user_id' => '2',
			'google_id' => 'ed@windowrnr.com',
			'google_calendar_id' => 'ghjh7fj2kgshbuf3b10vo11gb8@group.calendar.google.com',
			'sales_check' => 1,
			'first_name' => 'Ed',
			'avatar' => 'WinPin1.png',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime], 

			['user_id' => '3',
			'google_id' => 'norm@windowrnr.com',
			'google_calendar_id' => '77mvu3ue7hvemvm60h8rb1iheg@group.calendar.google.com',
			'sales_check' => 1,
			'first_name' => 'Norm',
			'avatar' => 'WinPin6.png',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

		);

		// Uncomment the below to run the seeder
		DB::table('profiles')->insert($profiles);
	}

}
