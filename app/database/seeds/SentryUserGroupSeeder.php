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

		$userUser = Sentry::getUserProvider()->findByLogin('user@user.com');
		$salesUser = Sentry::getUserProvider()->findByLogin('admin@admin.com');
		$userUser = Sentry::getUserProvider()->findByLogin('norm@norm.com');
		$salesUser = Sentry::getUserProvider()->findByLogin('norm@norm.com');
		$adminUser = Sentry::getUserProvider()->findByLogin('admin@admin.com');

		$userGroup = Sentry::getGroupProvider()->findByName('Users');
		$salesGroup = Sentry::getGroupProvider()->findByName('Sales');
		$adminGroup = Sentry::getGroupProvider()->findByName('Admins');

	    // Assign the groups to the users
	    $userUser->addGroup($userGroup);
		$salesUser->addGroup($salesGroup);
	    $adminUser->addGroup($userGroup);
	    $adminUser->addGroup($adminGroup);
	}

}