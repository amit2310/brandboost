<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAccountRefillHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_account_refill_history', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('refill_type', 45)->nullable()->comment('membership refill or topup refill');
			$table->float('credits', 10, 0)->nullable();
			$table->integer('contact_limit')->nullable();
			$table->integer('email_limit')->nullable();
			$table->integer('sms_limit')->nullable();
			$table->integer('mms_limit')->nullable();
			$table->integer('text_review_limit');
			$table->integer('video_review_limit');
			$table->float('credits_topup', 10, 0)->nullable();
			$table->integer('contact_limit_topup')->nullable();
			$table->integer('email_topup')->nullable();
			$table->integer('sms_topup')->nullable();
			$table->integer('mms_topup')->nullable();
			$table->float('last_unused_credits', 10, 0)->nullable();
			$table->integer('last_unused_contact')->nullable();
			$table->integer('last_unused_email')->nullable();
			$table->integer('last_unused_sms')->nullable();
			$table->integer('last_unused_mms')->nullable();
			$table->integer('last_unused_text_review');
			$table->integer('last_unused_video_review');
			$table->float('last_unused_credits_topup', 10, 0)->nullable();
			$table->integer('last_unused_contact_limit_topup')->nullable();
			$table->integer('last_unused_email_topup')->nullable();
			$table->integer('last_unused_sms_topup')->nullable();
			$table->integer('last_unused_mms_topup')->nullable();
			$table->integer('infusion_product_id')->nullable()->index('membership_level_id');
			$table->string('plan_id')->nullable();
			$table->text('notes', 65535)->nullable();
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
		Schema::drop('tbl_account_refill_history');
	}

}
