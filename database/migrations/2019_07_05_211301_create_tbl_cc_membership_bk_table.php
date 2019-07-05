<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCcMembershipBkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_cc_membership_bk', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('base_plan_id');
			$table->string('type', 55);
			$table->string('subs_cycle', 55)->nullable();
			$table->string('level_name', 45)->nullable();
			$table->text('invoice_name', 65535)->comment('This plan name will be display on invoice');
			$table->string('price', 45)->nullable();
			$table->float('credits', 10, 0)->nullable();
			$table->integer('contact_limit')->nullable();
			$table->integer('email_limit')->nullable();
			$table->integer('sms_limit')->nullable();
			$table->integer('mms_limit')->nullable();
			$table->integer('text_review_limit')->nullable();
			$table->integer('video_review_limit')->nullable();
			$table->string('social_invite_sources', 45)->nullable();
			$table->boolean('custom_addons')->nullable();
			$table->string('plan_id');
			$table->text('description')->nullable();
			$table->integer('status')->nullable()->default(1);
			$table->integer('delete_status')->default(0);
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
		Schema::drop('tbl_cc_membership_bk');
	}

}
