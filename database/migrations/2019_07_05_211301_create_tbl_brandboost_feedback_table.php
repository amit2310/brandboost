<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostFeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_feedback', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type', 11)->default('offsite')->comment('onsite or offsite');
			$table->integer('client_id');
			$table->integer('subscriber_id');
			$table->integer('brandboost_id');
			$table->text('title', 65535)->nullable();
			$table->text('feedback', 65535);
			$table->string('category', 100);
			$table->string('direction', 55)->nullable();
			$table->boolean('status')->default(1);
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
		Schema::drop('tbl_brandboost_feedback');
	}

}
