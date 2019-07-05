<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNpsAutomationsTrackingTwillioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nps_automations_tracking_twillio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('event_name', 11)->nullable();
			$table->string('to_number')->nullable();
			$table->string('from_number')->nullable();
			$table->integer('subscriber_id')->nullable()->index('subscriber_id');
			$table->integer('nps_id')->nullable()->index('brandboost_id');
			$table->integer('event_id')->nullable()->index('event_id');
			$table->integer('campaign_id')->nullable()->index('campaign_id');
			$table->string('account_sid')->nullable()->index('account_sid');
			$table->text('status', 65535)->nullable();
			$table->string('event_time')->nullable();
			$table->dateTime('created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_nps_automations_tracking_twillio');
	}

}
