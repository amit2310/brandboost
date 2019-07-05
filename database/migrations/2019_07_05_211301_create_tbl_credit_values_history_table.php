<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCreditValuesHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_credit_values_history', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('feature_key', 55)->nullable();
			$table->string('feature_name')->nullable();
			$table->string('credit_value', 11)->nullable();
			$table->integer('status')->default(1);
			$table->dateTime('created')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_credit_values_history');
	}

}
