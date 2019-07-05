<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralRewardsPromoLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_rewards_promo_links', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('reward_id')->nullable()->index('reward_id');
			$table->text('link_url', 65535)->nullable();
			$table->text('link_desc', 65535)->nullable();
			$table->string('expiry', 55)->nullable();
			$table->string('expiry_specific_date', 10)->nullable();
			$table->dateTime('updated')->nullable();
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
		Schema::drop('tbl_referral_rewards_promo_links');
	}

}
