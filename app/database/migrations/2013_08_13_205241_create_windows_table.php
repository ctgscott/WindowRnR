<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWindowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('windows', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cust_id');
			$table->integer('job_id');
			$table->integer('num');
			$table->string('description');
			$table->string('room');
			$table->integer('service_id');
			$table->decimal('actual_price');
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
		Schema::drop('windows');
	}

}
