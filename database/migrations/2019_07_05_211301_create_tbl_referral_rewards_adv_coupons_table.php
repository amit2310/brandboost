<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralRewardsAdvCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_rewards_adv_coupons', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('reward_id')->nullable()->index('reward_id');
			$table->integer('advocate_discount')->nullable();
			$table->string('advocate_discount_type', 10)->nullable();
			$table->text('advocate_display_msg', 65535)->nullable();
			$table->string('advocate_coupon_type', 10)->nullable()->comment('single or multiple(Usage)');
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
		Schema::drop('tbl_referral_rewards_adv_coupons');
	}

}
