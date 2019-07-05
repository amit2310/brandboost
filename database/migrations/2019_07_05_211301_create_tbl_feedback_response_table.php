<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblFeedbackResponseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_feedback_response', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('brandboost_id');
			$table->string('feedback_type', 55)->nullable();
			$table->string('ratings_type', 50)->nullable();
			$table->string('from_name', 55)->nullable();
			$table->string('from_email', 55)->nullable();
			$table->string('sms_sender', 55)->nullable();
			$table->text('pos_title', 65535)->nullable();
			$table->text('pos_sub_title', 65535)->nullable();
			$table->text('neg_title', 65535)->nullable();
			$table->text('neg_sub_title', 65535)->nullable();
			$table->text('neu_title', 65535)->nullable();
			$table->text('neu_sub_title', 65535)->nullable();
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
		Schema::drop('tbl_feedback_response');
	}

}
