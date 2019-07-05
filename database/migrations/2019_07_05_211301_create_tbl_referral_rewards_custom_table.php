<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralRewardsCustomTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_rewards_custom', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('reward_id')->nullable()->index('reward_id');
			$table->text('reward_title', 65535)->nullable();
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
		Schema::drop('tbl_referral_rewards_custom');
	}

}
