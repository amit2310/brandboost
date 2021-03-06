<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('user_id')->nullable();
			$table->integer('affiliateid')->nullable();
			$table->integer('affiliate_referralid')->nullable();
			$table->string('account_id')->nullable();
			$table->integer('subscriber_id')->nullable();
			$table->boolean('status')->nullable()->default(1);
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
		Schema::drop('tbl_referral_users');
	}

}
