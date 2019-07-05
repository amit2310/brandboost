<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBroadcastEmailsInviterQueueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_broadcast_emails_inviter_queue', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('campaign_type', 55)->comment('email or sms');
			$table->string('to', 55);
			$table->string('from_entity');
			$table->string('from_name')->nullable();
			$table->string('reply_email')->nullable();
			$table->string('subject');
			$table->text('content', 65535);
			$table->integer('broadcast_id')->nullable()->index('broadcast_id');
			$table->integer('campaign_id')->index('campaign_id');
			$table->string('sending_method', 11)->default('normal');
			$table->integer('sending_server_id')->index('sending_server_id');
			$table->integer('inviter_id')->index('inviter_id');
			$table->integer('subscriber_id');
			$table->integer('preceded_by');
			$table->string('message_id')->index('message_id');
			$table->integer('client_id')->nullable();
			$table->string('module_name', 55)->nullable();
			$table->string('moduleName', 55)->nullable();
			$table->string('moduleUnitId', 55)->nullable();
			$table->string('globalSubscriberId', 55)->nullable();
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
		Schema::drop('tbl_broadcast_emails_inviter_queue');
	}

}
