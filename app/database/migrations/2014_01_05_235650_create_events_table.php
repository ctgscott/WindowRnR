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
			$table->integer('start');
			$table->integer('end');
			$table->string('location');
			$table->string('description');
			$table->integer('all_day');
			$table->string('title');
			$table->string('created_by');
			$table->string('event_type');
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
