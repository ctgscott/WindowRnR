<?php

class NotesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('notes')->truncate();

		$notes = array(
			['job_id' => '1', 
			'user_id' => '1',
			'note' => 'Lead created.',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['job_id' => '1', 
			'user_id' => '1',
			'note' => '6 wood DHs, all need tune-up, please call before arriving.',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['job_id' => '2', 
			'user_id' => '2',
			'note' => 'Lead created.',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['job_id' => '2', 
			'user_id' => '2',
			'note' => '6 wood DHs, all need tune-up, please call before arriving.',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],
		);

		// Uncomment the below to run the seeder
		DB::table('notes')->insert($notes);
	}

}
