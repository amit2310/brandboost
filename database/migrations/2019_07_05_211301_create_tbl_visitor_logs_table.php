<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblVisitorLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_visitor_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable();
			$table->integer('source_client_id')->nullable();
			$table->string('source_page')->nullable();
			$table->text('source_id', 65535)->nullable();
			$table->string('source_type', 100)->nullable();
			$table->string('ip_address')->nullable();
			$table->string('platform')->nullable();
			$table->string('platform_device')->nullable();
			$table->string('browser')->nullable();
			$table->text('useragent', 65535)->nullable();
			$table->string('country')->nullable();
			$table->string('countryCode')->nullable();
			$table->string('region')->nullable();
			$table->string('city')->nullable();
			$table->string('longitude')->nullable();
			$table->string('latitude')->nullable();
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
		Schema::drop('tbl_visitor_logs');
	}

}
