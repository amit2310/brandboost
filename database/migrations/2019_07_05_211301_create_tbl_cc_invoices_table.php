<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCcInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_cc_invoices', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('customer_id', 55)->nullable();
			$table->integer('cc_invoice_id');
			$table->string('title')->nullable();
			$table->string('invoice_status', 10)->nullable();
			$table->boolean('is_recurring');
			$table->string('subscription_id', 55)->nullable();
			$table->string('txn_id', 55)->nullable();
			$table->string('txn_status', 10)->nullable();
			$table->string('total', 10)->nullable();
			$table->string('amount_paid', 10)->nullable();
			$table->string('amount_due', 10)->nullable();
			$table->string('currency', 10)->nullable();
			$table->string('bill_firstname', 55)->nullable();
			$table->string('bill_lastname', 55)->nullable();
			$table->string('bill_zip', 10)->nullable();
			$table->string('paid_at', 55)->nullable();
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
		Schema::drop('tbl_cc_invoices');
	}

}
