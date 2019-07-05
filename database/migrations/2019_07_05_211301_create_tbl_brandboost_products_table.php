<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_products', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('brandboost_id');
			$table->integer('user_id');
			$table->string('product_name')->nullable();
			$table->text('product_description', 65535)->nullable();
			$table->string('product_image')->nullable();
			$table->integer('product_order')->nullable();
			$table->string('product_type', 10)->nullable()->default('product')->comment('"product" and "service"');
			$table->integer('status')->nullable()->default(1);
			$table->integer('delete_status')->nullable()->default(0);
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
		Schema::drop('tbl_brandboost_products');
	}

}
