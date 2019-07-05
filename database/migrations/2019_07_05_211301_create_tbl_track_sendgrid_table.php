<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTrackSendgridTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_track_sendgrid', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('event_name', 11)->nullable();
			$table->string('email')->nullable();
			$table->integer('subscriber_id')->nullable()->index('subscriber_id');
			$table->integer('brandboost_id')->nullable()->index('brandboost_id');
			$table->integer('event_id')->nullable()->index('event_id');
			$table->integer('campaign_id')->nullable()->index('campaign_id');
			$table->string('click_url')->nullable();
			$table->string('ip')->nullable();
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
		Schema::drop('tbl_track_sendgrid');
	}

}
