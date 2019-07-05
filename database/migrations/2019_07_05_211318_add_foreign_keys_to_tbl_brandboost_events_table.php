<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblBrandboostEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_brandboost_events', function(Blueprint $table)
		{
			$table->foreign('brandboost_id', 'fk_tbl_brandboost_events')->references('id')->on('tbl_brandboost')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_brandboost_events', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_brandboost_events');
		});
	}

}
