<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralRewardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_rewards', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('hashcode')->nullable();
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('title')->nullable();
			$table->string('source_type', 50)->nullable();
			$table->integer('adv_coupon_id')->nullable()->index('coupon_id')->comment('advocate coupon id');
			$table->integer('ref_coupon_id')->nullable()->comment('referral coupon id');
			$table->integer('cash_id')->nullable()->index('cash_id')->comment('advocate discount');
			$table->integer('custom_id')->nullable()->index('custom_id')->comment('advocate discount');
			$table->integer('promo_id')->nullable()->index('promo_id')->comment('referred discount');
			$table->string('no_discount', 10)->nullable()->comment('referred discount');
			$table->integer('deleted')->default(0);
			$table->string('status', 10)->default('active');
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
		Schema::drop('tbl_referral_rewards');
	}

}
