<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblFailedOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_failed_orders', function(Blueprint $table)
		{
			$table->foreign('infusion_invoice_id', 'fk_tbl_failed_orders')->references('infusion_invoice_id')->on('tbl_invoices')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_failed_orders', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_failed_orders');
		});
	}

}
