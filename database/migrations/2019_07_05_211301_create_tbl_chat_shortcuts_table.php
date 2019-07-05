<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblChatShortcutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_chat_shortcuts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 55);
			$table->text('conversatation', 65535);
			$table->dateTime('created');
			$table->integer('status')->default(0);
			$table->integer('user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_chat_shortcuts');
	}

}
