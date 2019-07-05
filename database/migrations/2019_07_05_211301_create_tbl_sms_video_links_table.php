<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSmsVideoLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_sms_video_links', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('token');
			$table->string('rand_string');
			$table->text('url', 65535);
			$table->string('sms_flow', 25)->comment('outgoing, incoming');
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
		Schema::drop('tbl_sms_video_links');
	}

}
