<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralAutomationsEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_automations_events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('referral_id')->nullable();
			$table->integer('settings_id')->unsigned()->nullable()->index('settings_id');
			$table->string('event_type')->nullable();
			$table->text('data', 65535)->nullable();
			$table->integer('reminder_loop')->default(1);
			$table->integer('total_reminder_loop')->default(1);
			$table->string('reminder_loop_status', 50)->default('start');
			$table->integer('previous_event_id')->unsigned()->nullable();
			$table->boolean('custom_order')->nullable();
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
		Schema::drop('tbl_referral_automations_events');
	}

}
