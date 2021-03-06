<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('l_name');
			$table->string('f_name');
			$table->string('phone');
			$table->string('alt_phone');
			$table->string('email');
			$table->string('billing_address');
			$table->string('billing_city');
			$table->string('billing_state');
			$table->integer('billing_zip');
			$table->timestamps();
		//	$table->timestamps()->default('CURRENT_TIMESTAMP');
			//$table->dateTime('created_at')->default("CURRENT_TIMESTAMP");
			//$table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
		});
	}

	public function down()
	{
		Schema::drop('customers');
	}
}
