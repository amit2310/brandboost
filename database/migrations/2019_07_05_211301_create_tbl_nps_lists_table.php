<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNpsListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nps_lists', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('nps_id')->unsigned()->nullable()->index('nps_id');
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
		Schema::drop('tbl_nps_lists');
	}

}
