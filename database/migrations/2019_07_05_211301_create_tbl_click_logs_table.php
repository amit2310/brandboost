<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblClickLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_click_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('message_id')->index('message_id');
			$table->string('url');
			$table->integer('brandboost_id')->nullable();
			$table->integer('client_id')->nullable();
			$table->integer('subscriber_id')->nullable();
			$table->integer('inviter_id')->nullable();
			$table->string('ip_address');
			$table->string('platform');
			$table->string('platform_device');
			$table->string('browser');
			$table->text('useragent', 65535);
			$table->string('country');
			$table->string('countryCode');
			$table->string('region');
			$table->string('city');
			$table->string('longitude');
			$table->string('latitude');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_click_logs');
	}

}
