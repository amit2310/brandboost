<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblInviterQueueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_inviter_queue', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('campaign_type', 55)->comment('email or sms');
			$table->string('to', 55);
			$table->string('from_entity');
			$table->string('subject');
			$table->text('content', 65535);
			$table->integer('campaign_id')->index('campaign_id');
			$table->integer('sending_server_id')->index('sending_server_id');
			$table->integer('inviter_id')->index('inviter_id');
			$table->integer('subscriber_id');
			$table->integer('preceded_by');
			$table->string('message_id')->index('message_id');
			$table->boolean('status')->default(1)->comment('1= sending, 2= paused');
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
		Schema::drop('tbl_inviter_queue');
	}

}
