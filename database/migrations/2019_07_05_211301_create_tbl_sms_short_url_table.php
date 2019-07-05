<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSmsShortUrlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_sms_short_url', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('to_number', 100)->nullable();
			$table->string('from_number', 100)->nullable();
			$table->text('sid', 65535)->nullable();
			$table->integer('subscriber_id')->nullable();
			$table->integer('brandboost_id')->nullable();
			$table->integer('event_id')->nullable();
			$table->integer('campaign_id')->nullable();
			$table->text('long_url', 65535)->nullable();
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
		Schema::drop('tbl_sms_short_url');
	}

}
