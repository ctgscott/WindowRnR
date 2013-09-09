<?php

class StockPartsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('stock_parts')->truncate();

		$stock_parts = array(
			['category' => '1',
			'part_num' => '12345',
			'description' => '14lb. Dual balancer',
			'mfg' => 'ACME',
			'price' => '27.95',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['category' => '1',
			'part_num' => '12344',
			'description' => '12lb. Dual balancer',
			'mfg' => 'ACME',
			'price' => '24.95',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],

			['category' => '2',
			'part_num' => '56789',
			'description' => '30 inch, 12lb. Spiral Balancer',
			'mfg' => 'Strybuc',
			'price' => '34.95',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],
		);

		// Uncomment the below to run the seeder
		DB::table('stock_parts')->insert($stock_parts);
	}

}
