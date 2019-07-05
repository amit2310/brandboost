<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblEmailOpenLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_email_open_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('userid');
			$table->string('subject');
			$table->integer('status')->default(1);
			$table->dateTime('created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_email_open_log');
	}

}
