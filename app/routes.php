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
Route::get('customers/estimateschedule', 'CustomersController@EstimateSchedule');
Route::get('customers/estimateschedule2', 'CustomersController@EstimateSchedule2');
Route::get('customers/archive/{id}', 'CustomersController@archive');
Route::get('customers/schedule/{id}', 'CustomersController@getScheduleID');
Route::post('customers/postGoogleInsert', 'CustomersController@postGoogleInsert');
Route::post('customers/newLead', 'CustomersController@newLead');
Route::post('customers/update', 'CustomersController@update');
Route::get('customers/autocomplete', 'CustomersController@autocomplete');
Route::get('customers/typeahead', 'CustomersController@typeahead');
Route::post('customers/jobDetail', 'JobsController@postJobDetailByCustID');
Route::get('customers/{id}', 'CustomersController@getDetailID');
Route::get('events/getGoogleCalEvents/{start}/{end}/{cal}', 'EventsController@getGoogleCalEvents');
Route::get('events/getCalEvents/{start?}/{end?}/{cal?}', 'EventsController@getCalEvents');
Route::get('events/updateEvents/{start?}/{end?}/{cal?}', 'EventsController@updateEvents');
Route::get('events/updateEventsTable', 'EventsController@updateEventsTable');
Route::post('profiles/postSalesCheckBox', 'ProfilesController@postSalesCheckBox');
Route::get('profiles/getSalesCheckBox', 'ProfilesController@getSalesCheckBox');
Route::get('profiles/getSalesCalID', 'ProfilesController@getSalesCalID');

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

Route::resource('statuses', 'StatusesController');

Route::resource('photos', 'PhotosController');

Route::resource('window_totals', 'Window_totalsController');

Route::resource('appointments', 'AppointmentsController');

Route::resource('profiles', 'ProfilesController');

Route::resource('estimates', 'EstimatesController');

Route::resource('events', 'EventsController');