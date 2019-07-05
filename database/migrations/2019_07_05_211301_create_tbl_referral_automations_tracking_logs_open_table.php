<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralAutomationsTrackingLogsOpenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_automations_tracking_logs_open', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('message_id')->nullable()->index('message_id');
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
		Schema::drop('tbl_referral_automations_tracking_logs_open');
	}

}
