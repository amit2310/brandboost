<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNpsMainTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nps_main', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('hashcode')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('title')->nullable();
			$table->string('widget_type', 20)->nullable()->default('bottom_fix');
			$table->string('platform', 10)->nullable()->comment('email, web, sms');
			$table->string('brand_name')->nullable();
			$table->text('brand_logo', 65535)->nullable();
			$table->string('email_from')->nullable();
			$table->string('email_replyto')->nullable();
			$table->string('email_subject')->nullable();
			$table->string('web_button_color', 10)->nullable();
			$table->string('web_text_color', 10)->nullable();
			$table->string('web_button_style', 10)->nullable();
			$table->string('web_button_shape', 10)->nullable();
			$table->string('web_int_text_color', 20);
			$table->string('web_button_text_color', 20);
			$table->string('web_button_over_text_color', 20);
			$table->string('web_button_over_color', 20);
			$table->text('description', 65535)->nullable();
			$table->text('question', 65535)->nullable();
			$table->integer('display_logo')->default(1);
			$table->integer('display_intro')->default(1);
			$table->integer('display_name')->default(1);
			$table->integer('display_email')->default(1);
			$table->integer('display_additional')->default(1);
			$table->integer('deleted')->default(0);
			$table->string('status', 10)->nullable();
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
		Schema::drop('tbl_nps_main');
	}

}
