<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSmsUserFavouriteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_sms_user_favourite', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('fav_user_id');
			$table->integer('curr_user_id');
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
		Schema::drop('tbl_sms_user_favourite');
	}

}
