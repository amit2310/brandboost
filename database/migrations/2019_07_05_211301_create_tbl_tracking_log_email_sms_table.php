<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTrackingLogEmailSmsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_tracking_log_email_sms', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('subscriber_id')->nullable()->index('user_id');
			$table->string('type', 45)->nullable();
			$table->integer('campaign_id')->nullable()->index('campaign_id');
			$table->integer('trigger_id');
			$table->integer('sending_server_id')->nullable()->index('sending_server_id');
			$table->string('message_id', 45)->nullable()->index('message_id');
			$table->string('subs_email')->nullable();
			$table->string('subs_phone')->nullable();
			$table->string('status', 11)->nullable();
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
		Schema::drop('tbl_tracking_log_email_sms');
	}

}
