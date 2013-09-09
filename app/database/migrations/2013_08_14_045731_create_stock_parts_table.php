<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockPartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stock_parts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category');
			$table->integer('part_num');
			$table->string('description');
			$table->string('mfg');
			$table->decimal('price');
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
		Schema::drop('stock_parts');
	}

}
