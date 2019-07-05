<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblInvoicesDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_invoices_details', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('infusion_user_id')->index('infusion_user_id');
			$table->integer('infusion_invoice_id')->nullable()->index('infusion_invoice_id');
			$table->integer('infusion_product_id')->nullable()->index('infusion_product_id');
			$table->string('item_name', 45)->nullable();
			$table->text('item_description')->nullable();
			$table->integer('item_quantity')->nullable();
			$table->string('price_per_unit', 45)->nullable();
			$table->string('notes')->nullable();
			$table->string('product_type', 45)->nullable();
			$table->integer('membership_level_id')->nullable()->index('membership_level_id');
			$table->string('subscription_name', 45)->nullable();
			$table->integer('ref_id')->nullable()->index('ref_id');
			$table->integer('subscription_id')->nullable()->index('subscription_id');
			$table->integer('subscription_plan_id')->nullable()->index('subscription_plan_id');
			$table->string('card_type', 11)->nullable();
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
		Schema::drop('tbl_invoices_details');
	}

}
