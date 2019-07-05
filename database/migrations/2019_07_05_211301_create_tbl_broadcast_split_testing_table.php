<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBroadcastSplitTestingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_broadcast_split_testing', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('broadcast_id');
			$table->string('test_name')->nullable();
			$table->integer('status')->default(1);
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
		Schema::drop('tbl_broadcast_split_testing');
	}

}
