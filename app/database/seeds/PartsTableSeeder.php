<?php

class PartsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('parts')->truncate();

		$parts = array(
			['cust_id' => '',
			'job_id' => '',
			'window_id' => '',
			'num' => '',
			'mfg_part_num' => '',
			'description' => '',
			'qty' => '',
			'stock_parts_id' => '',
			'part_price' => '',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],
		);

		// Uncomment the below to run the seeder
		// DB::table('parts')->insert($parts);
	}

}
