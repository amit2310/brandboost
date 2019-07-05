<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_cities', function(Blueprint $table)
		{
			$table->foreign('state_id', 'fk_tbl_cities')->references('id')->on('tbl_states')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_cities', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_cities');
		});
	}

}
