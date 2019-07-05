<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_notes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('referral_response_id')->nullable()->index('referral_response_id');
			$table->integer('user_id')->index('user_id');
			$table->integer('referral_id')->nullable()->index('referral_id');
			$table->text('notes', 65535)->nullable();
			$table->boolean('status')->default(1);
			$table->dateTime('created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_referral_notes');
	}

}
