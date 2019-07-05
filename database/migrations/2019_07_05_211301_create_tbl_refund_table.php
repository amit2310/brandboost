<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblRefundTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_refund', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('refunded_by')->nullable()->index('refunded_by');
			$table->string('refund_type', 45)->nullable();
			$table->integer('invoices_details_id')->nullable()->index('invoices_details_id');
			$table->string('total_paid', 45)->nullable();
			$table->integer('refund_percentage')->nullable();
			$table->string('refund_amount', 45)->nullable();
			$table->string('agent_notes')->nullable();
			$table->boolean('refund_status')->nullable();
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
		Schema::drop('tbl_refund');
	}

}
