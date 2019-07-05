<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_sales', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('account_id', 100)->nullable();
			$table->integer('advocate_id')->nullable();
			$table->string('affiliateid')->nullable();
			$table->string('refkey')->nullable();
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->string('email')->nullable();
			$table->string('invoice_id')->nullable();
			$table->string('amount')->nullable();
			$table->string('currency')->nullable();
			$table->dateTime('purchase_date')->nullable();
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
		Schema::drop('tbl_referral_sales');
	}

}
