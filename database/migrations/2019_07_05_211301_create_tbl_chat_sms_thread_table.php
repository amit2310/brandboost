<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblChatSmsThreadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_chat_sms_thread', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('token', 55);
			$table->string('twilio_token');
			$table->string('from', 55)->nullable();
			$table->string('to', 55)->nullable();
			$table->text('msg', 65535)->nullable();
			$table->string('module_name', 55)->nullable();
			$table->integer('subscriber_id')->nullable();
			$table->integer('event_id')->nullable();
			$table->integer('broadcast_id')->nullable();
			$table->integer('automation_id')->nullable();
			$table->integer('nps_id')->nullable();
			$table->integer('nps_step')->nullable();
			$table->integer('nps_score_id')->nullable();
			$table->integer('referral_id')->nullable();
			$table->integer('brandboost_id')->nullable();
			$table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('read_status')->default(0);
			$table->string('media_type', 25)->nullable();
			$table->text('media_url_show', 65535)->nullable();
			$table->string('team_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_chat_sms_thread');
	}

}
