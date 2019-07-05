<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblChatMainTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_chat_main', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('hashcode')->nullable();
			$table->integer('user_id')->nullable();
			$table->string('title')->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('domain');
			$table->integer('logo_show')->default(1);
			$table->integer('title_show')->default(1);
			$table->integer('subtitle_show')->default(1);
			$table->integer('atttachment_show')->default(1);
			$table->integer('smilie_show')->default(1);
			$table->string('chat_logo');
			$table->integer('trigger_time');
			$table->text('trigger_message', 65535);
			$table->integer('desktop_visiable')->default(1);
			$table->integer('mobile_visiable')->nullable()->default(1);
			$table->integer('allow_gift_message')->default(0);
			$table->text('gift_message', 65535);
			$table->integer('company_info')->default(1);
			$table->string('company_title');
			$table->text('company_description', 65535);
			$table->string('position')->default('right');
			$table->string('header_color')->default('green');
			$table->string('header_custom_color1');
			$table->string('header_custom_color2');
			$table->string('header_solid_color');
			$table->integer('header_color_fix')->default(1);
			$table->integer('header_color_custom')->default(0);
			$table->integer('header_color_solid')->default(0);
			$table->string('color_orientation', 100);
			$table->string('chat_icon')->default('3');
			$table->integer('notification')->default(1);
			$table->integer('branding')->default(1);
			$table->integer('automated_message')->default(1);
			$table->text('messages', 65535);
			$table->text('time', 65535);
			$table->integer('contact_details_config')->nullable()->default(0);
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
		Schema::drop('tbl_chat_main');
	}

}
