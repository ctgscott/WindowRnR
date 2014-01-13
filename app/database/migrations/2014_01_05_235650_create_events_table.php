<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
			$table->increments('id');
			$table->string('google_event_id');
			$table->string('google_cal_id');
			$table->smallInteger('cal_user_id', 4);
			$table->string('avatar');
			$table->string('start');
			$table->string('end');
			$table->string('location');
			$table->string('description');
			$table->integer('allDay');
			$table->string('title');
			$table->string('created_by');
			$table->string('event_type');
			$table->decimal('lat', 10, 8);
			$table->decimal('lng', 11, 8);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}
