<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUsersNotificationSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_users_notification_settings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('inactivity_length')->default(10);
			$table->string('notify_email', 55)->nullable();
			$table->string('notify_phone', 55);
			$table->integer('notify_sound')->default(1);
			$table->integer('browser_notify')->default(1);
			$table->integer('system_notify')->default(1);
			$table->integer('email_notify')->default(1);
			$table->integer('sms_notify')->default(0);
			$table->integer('sys_assign_chat')->default(1);
			$table->integer('sys_onsite_review_add')->default(1);
			$table->integer('sys_offsite_review_add')->default(1);
			$table->integer('sys_nps_score_add')->default(1);
			$table->integer('sys_referral_add')->default(1);
			$table->integer('sys_media_add')->default(1);
			$table->integer('sys_workflow_action')->default(1);
			$table->integer('email_assign_chat')->default(1);
			$table->integer('email_onsite_review_add')->nullable()->default(1);
			$table->integer('email_offsite_review_add')->default(1);
			$table->integer('email_nps_score_add')->default(1);
			$table->integer('email_referral_add')->default(1);
			$table->integer('email_media_add')->default(1);
			$table->integer('email_workflow_action')->default(1);
			$table->dateTime('updated')->nullable();
			$table->dateTime('created')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_users_notification_settings');
	}

}
