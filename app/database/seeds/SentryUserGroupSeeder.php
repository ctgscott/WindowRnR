<?php

class SentryUserGroupSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users_groups')->delete();

		$userUser = Sentry::getUserProvider()->findByLogin('ed@windowrnr.com');
		$salesUser = Sentry::getUserProvider()->findByLogin('scott@windowrnr.com');
		$userUser = Sentry::getUserProvider()->findByLogin('norm@windowrnr.com');
		$salesUser = Sentry::getUserProvider()->findByLogin('norm@windowrnr.com');
		$adminUser = Sentry::getUserProvider()->findByLogin('scott@windowrnr.com');

		$userGroup = Sentry::getGroupProvider()->findByName('Users');
		$salesGroup = Sentry::getGroupProvider()->findByName('Sales');
		$adminGroup = Sentry::getGroupProvider()->findByName('Admins');

	    // Assign the groups to the users
	    $userUser->addGroup($userGroup);
		$salesUser->addGroup($salesGroup);
	    $adminUser->addGroup($userGroup);
		$adminUser->addGroup($salesGroup);
	    $adminUser->addGroup($adminGroup);
	}

}