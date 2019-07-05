<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTwilioLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_twilio_logs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('direction', 25)->nullable();
			$table->string('sent_from')->nullable();
			$table->string('sent_to')->nullable();
			$table->string('price')->nullable();
			$table->string('sid')->nullable();
			$table->string('status', 25)->nullable();
			$table->dateTime('dateSent')->nullable();
			$table->text('body', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_twilio_logs');
	}

}
