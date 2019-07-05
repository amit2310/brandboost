<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblFailedOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_failed_orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('infusion_invoice_id')->nullable()->index('infusion_invoice_id');
			$table->integer('infusion_user_id')->nullable()->index('infusion_user_id');
			$table->integer('job_id')->nullable()->index('job_id');
			$table->string('invoice_total', 45)->nullable();
			$table->string('total_paid', 45)->nullable();
			$table->string('total_due', 45)->nullable();
			$table->boolean('pay_status')->nullable();
			$table->text('description')->nullable();
			$table->integer('membership_level_id')->nullable()->index('membership_level_id');
			$table->integer('mid')->nullable();
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
		Schema::drop('tbl_failed_orders');
	}

}
