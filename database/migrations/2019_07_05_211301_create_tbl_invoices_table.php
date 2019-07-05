<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_invoices', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('infusion_user_id')->nullable()->index('infusion_user_id');
			$table->integer('infusion_invoice_id')->nullable()->index('infusion_invoice_id');
			$table->integer('infusion_job_id')->nullable()->index('infusion_job_id');
			$table->string('invoice_total', 45)->nullable();
			$table->string('total_paid', 45)->nullable();
			$table->string('total_due', 45)->nullable();
			$table->boolean('pay_status')->nullable();
			$table->string('transaction_id', 45)->nullable();
			$table->text('description')->nullable();
			$table->integer('subscription_plan_id')->nullable()->index('membership_level_id');
			$table->integer('mid')->nullable()->index('mid');
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
		Schema::drop('tbl_invoices');
	}

}
