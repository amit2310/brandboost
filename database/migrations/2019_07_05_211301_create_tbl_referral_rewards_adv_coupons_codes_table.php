<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralRewardsAdvCouponsCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_rewards_adv_coupons_codes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('coupon_id')->nullable()->index('coupon_id');
			$table->string('coupon_code')->nullable();
			$table->string('expiry')->nullable();
			$table->string('expiry_specific_date', 11)->nullable();
			$table->string('usage_type', 10)->nullable()->comment('single or multiple(Usage)');
			$table->integer('coupon_status')->nullable()->comment('1=active, 0=expired');
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
		Schema::drop('tbl_referral_rewards_adv_coupons_codes');
	}

}
