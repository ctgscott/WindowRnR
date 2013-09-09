<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cust_id');
			$table->integer('job_id');
			$table->integer('window_id');
			$table->integer('num');
			$table->string('mfg_part_num');
			$table->string('description');
			$table->integer('qty');
			$table->integer('stock_parts_id');
			$table->decimal('part_price');
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
		Schema::drop('parts');
	}

}
