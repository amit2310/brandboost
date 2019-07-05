<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNpsScoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nps_score', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('refkey')->nullable()->index('message_id');
			$table->integer('subscriber_id')->nullable();
			$table->integer('score')->nullable();
			$table->text('title', 65535)->nullable();
			$table->string('feedback_fullname')->nullable();
			$table->string('feedback_email')->nullable();
			$table->text('feedback', 65535)->nullable();
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
		Schema::drop('tbl_nps_score');
	}

}
