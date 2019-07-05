<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblWidgetDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_widget_data', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('campaign_id');
			$table->string('user_ip', 50);
			$table->integer('often_user')->default(0);
			$table->string('widget_type', 20);
			$table->dateTime('created_date');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_widget_data');
	}

}
