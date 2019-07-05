<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_settings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable();
			$table->integer('referral_id')->nullable();
			$table->string('store_name', 200)->nullable();
			$table->string('store_url')->nullable();
			$table->string('store_email')->nullable();
			$table->text('facebook_title', 65535)->nullable();
			$table->text('facebook_desc', 65535)->nullable();
			$table->text('twitter_title', 65535)->nullable();
			$table->text('twitter_desc', 65535)->nullable();
			$table->text('site_link', 65535)->nullable();
			$table->string('notification_source', 11)->nullable();
			$table->string('invite_delay')->nullable();
			$table->string('sale_delay', 55)->nullable();
			$table->string('reminder_delay', 55)->nullable();
			$table->string('reminder_delay_invite', 55);
			$table->string('timezone', 100)->nullable();
			$table->string('status', 10)->default('active');
			$table->string('deleted', 10)->default('0');
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
		Schema::drop('tbl_referral_settings');
	}

}
