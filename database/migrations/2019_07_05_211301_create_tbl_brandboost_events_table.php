<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('brandboost_id')->index('automation_id');
			$table->string('event_type');
			$table->text('data', 65535);
			$table->integer('previous_event_id')->nullable();
			$table->string('created', 50);
			$table->string('updated', 50);
			$table->boolean('status')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_brandboost_events');
	}

}
