<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNpsAutomationsTriggersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nps_automations_triggers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('auto_event_id')->unsigned()->index('auto_event_id');
			$table->integer('subscriber_id')->unsigned()->nullable()->index('subscriber_id');
			$table->integer('preceded_by')->unsigned()->nullable()->index('preceded_by');
			$table->integer('sale_id')->nullable();
			$table->dateTime('start_at')->nullable();
			$table->dateTime('created_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_nps_automations_triggers');
	}

}
