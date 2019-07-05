<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationsEmailsEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automations_emails_events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('automation_id')->unsigned()->nullable()->index('automation_id');
			$table->string('event_type')->nullable();
			$table->text('data', 65535)->nullable();
			$table->integer('previous_event_id')->unsigned()->nullable();
			$table->boolean('custom_order')->nullable();
			$table->dateTime('updated')->nullable();
			$table->dateTime('created')->nullable();
			$table->string('status', 10)->nullable()->default('draft');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_automations_emails_events');
	}

}
