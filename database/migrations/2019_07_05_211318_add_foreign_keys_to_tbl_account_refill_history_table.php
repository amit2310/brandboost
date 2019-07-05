<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblAccountRefillHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_account_refill_history', function(Blueprint $table)
		{
			$table->foreign('user_id', 'fk_tbl_account_refill_history')->references('id')->on('tbl_users')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_account_refill_history', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_account_refill_history');
		});
	}

}
