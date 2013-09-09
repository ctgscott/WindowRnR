<?php

class CustomersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('customers')->truncate();

		$customers = array(
			['l_name' => 'Campbell', 
			'f_name' => 'Scott',
			'billing_address' => '2612 Via Campesina',
			'billing_city' => 'Palos Verdes Estates',
			'billing_state' => 'CA',
			'billing_zip' => '90274',
			'phone' => '(424) 226-2355',
			'email' => 'ctgscott@gmail.com',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime],
			
			['l_name' => 'Sanchez', 
			'f_name' => 'Ed',
			'billing_address' => '123 Main Street',
			'billing_city' => 'Los Alamitos',
			'billing_state' => 'CA',
			'billing_zip' => '90720',
			'phone' => '(424) 226-2355',
			'email' => 'edwindowrepair@yahoo.co',
			'created_at' => new DateTime, 
			'updated_at' => new DateTime
			],
		);

		// Uncomment the below to run the seeder
		DB::table('customers')->insert($customers);
	}

}
