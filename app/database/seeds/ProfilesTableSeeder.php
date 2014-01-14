<?php

class ProfilesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('profiles')->truncate();

		$profiles = array(
			['user_id' => '1',
			'google_id' => 'scott@windowrnr.com',
			'google_calendar_id' => 'windowrnr.com_g67gtb3doc8ehsdaffpe1idaq4@group.calendar.google.com',
			'avatar' => 'WinPin7.png',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['user_id' => '2',
			'google_id' => 'ed@windowrnr.com',
			'google_calendar_id' => 'windowrnr.com_67ra671l2aj4h82q1dosigd31c@group.calendar.google.com',
			'avatar' => 'WinPin1.png',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime], 

			['user_id' => '3',
			'google_id' => 'norm@windowrnr.com',
			'google_calendar_id' => 'windowrnr.com_c7df92ao3vvg02n2kh52b81tn4@group.calendar.google.com',
			'avatar' => 'WinPin6.png',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

		);

		// Uncomment the below to run the seeder
		DB::table('profiles')->insert($profiles);
	}

}
