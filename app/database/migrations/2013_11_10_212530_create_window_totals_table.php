<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWindowTotalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('window_totals', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('job_id');
			$table->integer('qty');
			$table->string('material');
			$table->string('style');
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
		Schema::drop('window_totals');
	}

}
