<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblChatSupportuserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_chat_supportuser', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('room', 233);
			$table->integer('supp_user');
			$table->bigInteger('user');
			$table->string('user_name');
			$table->string('email', 100)->nullable();
			$table->string('phone', 55);
			$table->string('ip_address', 50)->nullable();
			$table->string('platform', 50)->nullable();
			$table->string('platform_device', 50)->nullable();
			$table->string('browser', 50)->nullable();
			$table->text('useragent', 65535)->nullable();
			$table->string('country')->nullable();
			$table->string('countryCode', 50)->nullable();
			$table->string('region')->nullable();
			$table->string('city')->nullable();
			$table->string('longitude', 50)->nullable();
			$table->string('latitude', 50)->nullable();
			$table->integer('status');
			$table->dateTime('created');
			$table->integer('assign_team_member')->default(0);
			$table->integer('favourite')->default(0);
			$table->dateTime('reply_time');
			$table->integer('completed')->default(0);
			$table->dateTime('completed_time');
			$table->dateTime('last_chat_time');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_chat_supportuser');
	}

}
