<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('SentryGroupSeeder');
		$this->call('SentryUserSeeder');
		$this->call('SentryUserGroupSeeder');
		$this->call('CustomersTableSeeder');
		$this->call('JobsTableSeeder');
		$this->call('ServicesTableSeeder');
		$this->call('WindowsTableSeeder');
		$this->call('PartsTableSeeder');
		$this->call('StockPartsTableSeeder');
		$this->call('StockPartCatsTableSeeder');
		$this->call('NotesTableSeeder');
	}

}