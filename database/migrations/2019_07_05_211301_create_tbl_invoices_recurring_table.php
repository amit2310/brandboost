<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblInvoicesRecurringTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_invoices_recurring', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('infusion_user_id')->nullable()->index('infusion_user_id');
			$table->integer('infusion_product_id')->nullable()->index('infusion_product_id');
			$table->integer('subscription_plan_id')->nullable()->index('subscription_id');
			$table->dateTime('subscription_start_date')->nullable();
			$table->dateTime('subscription_end_date')->nullable();
			$table->dateTime('last_bill_date')->nullable();
			$table->dateTime('next_bill_date')->nullable();
			$table->integer('billing_cycle')->nullable();
			$table->integer('frequency')->nullable();
			$table->integer('merchant_id')->nullable()->index('merchant_id');
			$table->string('invoice_total', 45)->nullable();
			$table->integer('quantity')->nullable();
			$table->integer('recurring_order_id')->nullable()->index('recurring_order_id');
			$table->text('dataset')->nullable();
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
		Schema::drop('tbl_invoices_recurring');
	}

}
