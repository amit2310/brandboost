<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblChatMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_chat_message', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('token', 225)->index('token');
			$table->bigInteger('user_to');
			$table->bigInteger('user_form');
			$table->text('message', 65535);
			$table->integer('read_status')->comment('1 = Read, 0 = Unread');
			$table->dateTime('created');
			$table->integer('status')->default(1)->comment('1 = Active, 0 = Inactive');
			$table->integer('team_member_id')->default(0);
			$table->integer('notes')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_chat_message');
	}

}
