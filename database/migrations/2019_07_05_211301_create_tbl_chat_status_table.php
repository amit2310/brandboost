<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblChatStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_chat_status', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->bigInteger('subscriber_id');
			$table->integer('status')->default(0);
			$table->string('type', 25);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_chat_status');
	}

}
