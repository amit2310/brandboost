<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblInvoicesDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_invoices_details', function(Blueprint $table)
		{
			$table->foreign('infusion_invoice_id', 'fk_tbl_invoices_details')->references('infusion_invoice_id')->on('tbl_invoices')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_invoices_details', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_invoices_details');
		});
	}

}
