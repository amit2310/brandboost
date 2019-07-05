<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTwilioAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_twilio_accounts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('account_sid', 100)->nullable();
			$table->string('account_token', 100)->nullable();
			$table->string('account_status', 45)->nullable();
			$table->string('contact_sid', 100)->nullable();
			$table->string('contact_no', 45)->nullable()->index('contact_no');
			$table->string('status', 45)->nullable()->default('1');
			$table->dateTime('created')->nullable();
			$table->string('twilio_cost');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_twilio_accounts');
	}

}
