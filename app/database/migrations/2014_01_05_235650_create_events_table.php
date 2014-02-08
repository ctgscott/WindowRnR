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
			$table->string('status');
			$table->string('creatorEmail');
			$table->string('organizerEmail');
			$table->string('htmlLink', 100);
			$table->timestamp('start');
			$table->timestamp('end');
			$table->string('location')->nullable();
			$table->string('description');
			$table->integer('allDay');
			$table->string('title');
			$table->string('created_by');
			$table->string('event_type');
			$table->decimal('lat', 10, 8)->nullable();
			$table->decimal('lng', 11, 8)->nullable();
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
