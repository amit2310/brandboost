<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralReflinksVisitLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_reflinks_visit_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('refkey')->nullable()->index('message_id');
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
		Schema::drop('tbl_referral_reflinks_visit_logs');
	}

}
