<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblFeedbackResponseLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_feedback_response_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('feedback_type', 55)->nullable();
			$table->integer('client_id');
			$table->integer('brandboost_id');
			$table->string('subscriber_id', 55)->nullable();
			$table->dateTime('created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_feedback_response_log');
	}

}
