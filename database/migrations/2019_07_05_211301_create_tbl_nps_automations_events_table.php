<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNpsAutomationsEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nps_automations_events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('nps_id')->unsigned()->nullable()->index('nps_id');
			$table->string('event_type')->nullable();
			$table->text('data', 65535)->nullable();
			$table->integer('previous_event_id')->unsigned()->nullable();
			$table->boolean('custom_order')->nullable();
			$table->integer('reminder_loop')->default(1);
			$table->integer('total_reminder_loop')->default(1);
			$table->string('reminder_loop_status', 50)->default('start');
			$table->dateTime('updated')->nullable();
			$table->dateTime('created')->nullable();
			$table->string('status', 10)->nullable()->default('active');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_nps_automations_events');
	}

}
