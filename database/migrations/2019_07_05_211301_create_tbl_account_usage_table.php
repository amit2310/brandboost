<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAccountUsageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_account_usage', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('subscription_plan_id');
			$table->float('credits', 10, 0)->nullable();
			$table->integer('contact_limit')->nullable();
			$table->float('email_balance', 10, 0)->nullable();
			$table->float('sms_balance', 10, 0)->nullable();
			$table->float('mms_balance', 10, 0)->nullable();
			$table->float('text_review_balance', 10, 0)->nullable();
			$table->float('video_review_balance', 10, 0)->nullable();
			$table->float('credits_topup', 10, 0)->nullable();
			$table->integer('contact_limit_topup')->nullable();
			$table->float('email_balance_topup', 10, 0)->nullable();
			$table->float('sms_balance_topup', 10, 0)->nullable();
			$table->float('mms_balance_topup', 10, 0)->nullable();
			$table->boolean('reached_limit')->default(0);
			$table->dateTime('last_updated');
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
		Schema::drop('tbl_account_usage');
	}

}
