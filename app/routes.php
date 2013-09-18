<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
Route::get('/', function()
{
	return View::make('users/login');
});
*/

Route::get('/', 'UserController@getIndex');
Route::get('customers/archive/{id}', 'CustomersController@archive');
Route::get('customers/schedule/{id}', 'CustomersController@getScheduleID');
Route::post('customers/estimateschedule', 'CustomersController@EstimateSchedule');
Route::get('customers/estimateschedule', 'CustomersController@EstimateSchedule');
Route::post('customers/estimateschedule2', 'CustomersController@EstimateSchedule2');
Route::post('customers/postGoogleInsert', 'CustomersController@postGoogleInsert');
//Route::get('customers/{id}', 'CustomersController@edit');

Route::get('social/{action?}', array("as" => "hybridauth", function($action = "")

{
	// check URL segment
	if ($action == "auth") {
		// process authentication
		try {
			Hybrid_Endpoint::process();
		}
		catch (Exception $e) {
			// redirect back to http://URL/social/
			return Redirect::route('hybridauth');
		}
		return;
	}
	try {
		// create a HybridAuth object
		$socialAuth = new Hybrid_Auth(app_path() . '/config/hybridauth.php');
		// authenticate with Google
		$provider = $socialAuth->authenticate("google");
		// fetch user profile
		$userProfile = $provider->getUserProfile();
	}
	catch(Exception $e) {
		// exception codes can be found on HybBridAuth's web site
		return $e->getMessage();
	}
	// access user profile data
	echo "Connected with: <b>{$provider->id}</b><br />";
	echo "As: <b>{$userProfile->displayName}</b><br />";
	echo "<pre>" . print_r( $userProfile, true ) . "</pre><br />";

	// logout
	$provider->logout();
}));



Route::controller('users', 'UserController');
Route::controller('customers/schedule', 'CustomersController'); 
Route::controller('customers', 'CustomersController');

Route::resource('groups', 'GroupController');






Route::resource('customers', 'CustomersController');

Route::resource('jobs', 'JobsController');

Route::resource('services', 'ServicesController');

Route::resource('windows', 'WindowsController');

Route::resource('parts', 'PartsController');

Route::resource('stock_parts', 'Stock_partsController');

Route::resource('stock_part_cats', 'Stock_part_catsController');

Route::resource('notes', 'NotesController');