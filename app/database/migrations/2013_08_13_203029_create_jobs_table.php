<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('customer_id');
			$table->integer('status');
			$table->boolean('archive');
			$table->string('created_by');
			$table->string('address');
			$table->string('city');
			$table->string('state');
			$table->string('zip');
			$table->string('built');
			$table->string('type');
			$table->text('symptoms');
			$table->string('lead_source');
			$table->timestamps();
			$table->timestamp('lead_scheduled');
			$table->timestamp('job_scheduled');
			$table->timestamp('job_completed');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs');
	}

}
