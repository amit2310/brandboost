<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNotificationsManagerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_notifications_manager', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('user_type', 25);
			$table->string('notification_name', 55)->nullable();
			$table->string('notification_slug', 55)->nullable();
			$table->string('category', 55);
			$table->integer('email')->default(0);
			$table->integer('sms')->default(0);
			$table->integer('system')->default(0);
			$table->integer('admin')->default(0);
			$table->integer('client')->default(0);
			$table->integer('user')->default(0);
			$table->string('email_subject_admin');
			$table->text('email_content_admin');
			$table->string('email_subject_client');
			$table->text('email_content_client');
			$table->string('email_subject_user');
			$table->text('email_content_user');
			$table->text('client_sms_content', 65535);
			$table->text('user_sms_content');
			$table->text('admin_sms_content', 65535);
			$table->string('admin_system_content');
			$table->string('client_system_content');
			$table->string('user_system_content');
			$table->integer('status')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_notifications_manager');
	}

}
