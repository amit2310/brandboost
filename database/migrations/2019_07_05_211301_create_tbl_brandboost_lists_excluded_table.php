<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostListsExcludedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_lists_excluded', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('brandboost_id')->unsigned()->nullable()->index('brandboost_id');
			$table->integer('list_id')->unsigned()->nullable()->index('list_id');
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
		Schema::drop('tbl_brandboost_lists_excluded');
	}

}
