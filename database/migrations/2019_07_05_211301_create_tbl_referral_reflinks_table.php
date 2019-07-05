<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralReflinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_reflinks', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('settings_id')->nullable();
			$table->integer('referral_id')->nullable();
			$table->integer('advocate_id')->nullable();
			$table->integer('subscriber_id')->nullable();
			$table->string('refkey')->nullable();
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
		Schema::drop('tbl_referral_reflinks');
	}

}
