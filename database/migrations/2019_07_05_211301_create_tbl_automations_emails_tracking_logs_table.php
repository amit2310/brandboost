<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationsEmailsTrackingLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automations_emails_tracking_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('campaign_type', 55);
			$table->integer('campaign_id')->unsigned()->index('campaign_id');
			$table->integer('subscriber_id')->unsigned()->index('subscriber_id');
			$table->string('message_id')->nullable()->index('message_id');
			$table->integer('auto_trigger_id')->index('auto_trigger_id');
			$table->string('subs_email')->nullable();
			$table->string('subs_phone')->nullable();
			$table->string('sending_type', 11)->default('normal')->comment('normal/split');
			$table->string('status', 10);
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
		Schema::drop('tbl_automations_emails_tracking_logs');
	}

}
