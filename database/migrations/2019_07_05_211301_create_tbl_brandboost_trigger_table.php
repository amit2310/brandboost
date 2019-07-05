<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostTriggerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_trigger', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('inviter_id')->unsigned()->index('inviter_id');
			$table->integer('subscriber_id')->unsigned()->nullable()->index('subscriber_id');
			$table->integer('preceded_by')->unsigned()->nullable();
			$table->dateTime('start_at')->nullable();
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
		Schema::drop('tbl_brandboost_trigger');
	}

}
