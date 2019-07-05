<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralRewardsCashTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_rewards_cash', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('reward_id')->nullable()->index('reward_id');
			$table->string('cash_amount', 55)->nullable();
			$table->string('cash_type', 55)->nullable();
			$table->text('display_msg', 65535)->nullable();
			$table->string('amount', 100);
			$table->string('amount_type', 100);
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
		Schema::drop('tbl_referral_rewards_cash');
	}

}
