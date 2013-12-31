<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('job_id');
			$table->integer('cust_id');
			$table->dateTime('appt_start');
			$table->dateTime('appt_end');
			$table->smallInteger('all_day');
			$table->string('appt_url');
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
		Schema::drop('appointments');
	}

}
