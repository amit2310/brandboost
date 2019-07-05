<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNotificationsSysTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_notifications_sys_templates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title')->nullable();
			$table->string('template_tag')->nullable();
			$table->text('tag_language', 65535)->nullable();
			$table->text('tag_language_admin', 65535)->nullable();
			$table->text('tag_language_user', 65535);
			$table->string('icon', 55)->nullable();
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
		Schema::drop('tbl_notifications_sys_templates');
	}

}
