<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralAffiliatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_affiliates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('advocate_id')->nullable();
			$table->integer('advocate_referral_id')->nullable();
			$table->integer('affiliate_id')->nullable();
			$table->integer('affiliate_referral_id')->nullable();
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
		Schema::drop('tbl_referral_affiliates');
	}

}
