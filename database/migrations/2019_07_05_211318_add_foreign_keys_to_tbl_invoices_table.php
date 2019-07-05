<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_invoices', function(Blueprint $table)
		{
			$table->foreign('infusion_user_id', 'fk_tbl_invoices')->references('infusion_user_id')->on('tbl_users')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_invoices', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_invoices');
		});
	}

}
