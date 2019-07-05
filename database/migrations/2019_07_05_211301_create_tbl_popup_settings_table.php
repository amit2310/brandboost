<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPopupSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_popup_settings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('login_frequency_lu', 50);
			$table->string('frequency_time_lu', 50);
			$table->string('login_frequency_au', 50);
			$table->string('frequency_time_au', 50);
			$table->string('updated', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_popup_settings');
	}

}
