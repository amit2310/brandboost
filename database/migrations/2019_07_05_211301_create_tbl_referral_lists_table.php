<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_lists', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('referral_id')->unsigned()->nullable()->index('referral_id');
			$table->integer('list_id')->unsigned()->nullable()->index('list_id');
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
		Schema::drop('tbl_referral_lists');
	}

}
