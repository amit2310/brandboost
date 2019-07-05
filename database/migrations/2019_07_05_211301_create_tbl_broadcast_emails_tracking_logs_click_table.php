<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBroadcastEmailsTrackingLogsClickTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_broadcast_emails_tracking_logs_click', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('message_id')->nullable()->index('message_id');
			$table->integer('broadcast_id')->nullable()->index('broadcast_id');
			$table->integer('client_id')->nullable()->index('client_id');
			$table->integer('subscriber_id')->nullable()->index('subscriber_id');
			$table->integer('inviter_id')->nullable()->index('inviter_id');
			$table->string('sending_method', 11)->default('normal');
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
		Schema::drop('tbl_broadcast_emails_tracking_logs_click');
	}

}
