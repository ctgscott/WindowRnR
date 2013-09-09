<?php

class StockPartCatsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('stock_part_cats')->truncate();

		$stock_part_cats = array(
			['description' => 'Dual Balancers',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['description' => 'Spiral Balancers',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],
		);

		// Uncomment the below to run the seeder
		DB::table('stock_part_cats')->insert($stock_part_cats);
	}

}
