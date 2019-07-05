<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblRefundTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_refund', function(Blueprint $table)
		{
			$table->foreign('invoices_details_id', 'fk_tbl_refund')->references('id')->on('tbl_invoices_details')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_refund', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_refund');
		});
	}

}
