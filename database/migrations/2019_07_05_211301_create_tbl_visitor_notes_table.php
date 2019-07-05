<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblVisitorNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_visitor_notes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('room', 235);
			$table->bigInteger('user');
			$table->text('message', 65535);
			$table->integer('client_id');
			$table->integer('team_id');
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
		Schema::drop('tbl_visitor_notes');
	}

}
