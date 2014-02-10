<?php

class SentryUserSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->delete();

		Sentry::getUserProvider()->create(array(
	        'email'    => 'scott@windowrnr.com',
	        'password' => 'sentryadmin',
	        'activated' => 1,
			'first_name' => 'Scott',
			'last_name' => 'Campbell'
	    ));

	    Sentry::getUserProvider()->create(array(
	        'email'    => 'ed@windowrnr.com',
	        'password' => 'sentryuser',
	        'activated' => 1,
			'first_name' => 'Ed',
			'last_name' => 'Sanchez'
	    ));
		
	    Sentry::getUserProvider()->create(array(
	        'email'    => 'norm@windowrnr.com',
	        'password' => 'sentrynorm',
	        'activated' => 1,
			'first_name' => 'Norm',
			'last_name' => 'Tuazon'
	    ));

	}

}