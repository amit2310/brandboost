<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNpsNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nps_notes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('score_id')->nullable()->index('score_id');
			$table->integer('user_id')->index('user_id');
			$table->integer('nps_id')->nullable()->index('nps_id');
			$table->text('notes', 65535)->nullable();
			$table->boolean('status')->default(1);
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
		Schema::drop('tbl_nps_notes');
	}

}
