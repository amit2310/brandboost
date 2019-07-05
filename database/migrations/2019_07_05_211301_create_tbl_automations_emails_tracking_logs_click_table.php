<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationsEmailsTrackingLogsClickTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automations_emails_tracking_logs_click', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('message_id')->nullable()->index('message_id');
			$table->integer('automation_id')->nullable();
			$table->integer('client_id')->nullable();
			$table->integer('subscriber_id')->nullable();
			$table->integer('inviter_id')->nullable();
			$table->string('url')->nullable();
			$table->string('ip_address')->nullable();
			$table->string('platform')->nullable();
			$table->string('platform_device')->nullable();
			$table->string('browser')->nullable();
			$table->text('useragent', 65535)->nullable();
			$table->string('country')->nullable();
			$table->string('countryCode')->nullable();
			$table->string('region')->nullable();
			$table->string('city')->nullable();
			$table->string('longitude')->nullable();
			$table->string('latitude')->nullable();
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
		Schema::drop('tbl_automations_emails_tracking_logs_click');
	}

}
