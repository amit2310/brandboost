<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCcInvoicesItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_cc_invoices_items', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('local_invoice_id');
			$table->string('cc_item_id', 55)->nullable();
			$table->string('amount', 55)->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('entity_type', 10)->nullable();
			$table->string('entity_id', 55)->nullable();
			$table->string('unit_amount', 55)->nullable();
			$table->integer('quantity');
			$table->string('date_from', 55)->nullable();
			$table->string('date_to', 55)->nullable();
			$table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_cc_invoices_items');
	}

}
