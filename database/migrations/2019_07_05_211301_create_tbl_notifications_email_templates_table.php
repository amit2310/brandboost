<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNotificationsEmailTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_notifications_email_templates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title')->nullable();
			$table->string('subject')->nullable();
			$table->string('template_tag')->nullable();
			$table->text('plain_text', 65535)->nullable();
			$table->string('subject_admin');
			$table->text('plain_text_admin', 65535);
			$table->string('subject_user');
			$table->text('plain_text_user', 65535);
			$table->string('content_type', 55)->nullable()->default('plain');
			$table->integer('send_sms')->nullable()->default(0);
			$table->text('sms_text_admin', 65535);
			$table->text('sms_text_client', 65535);
			$table->text('sms_text_user', 65535);
			$table->integer('write_permission')->default(1);
			$table->integer('status')->default(1);
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
		Schema::drop('tbl_notifications_email_templates');
	}

}
