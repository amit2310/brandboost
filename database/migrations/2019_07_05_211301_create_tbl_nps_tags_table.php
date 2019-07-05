<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNpsTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nps_tags', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('tag_id')->nullable()->index('tag_id');
			$table->integer('score_id')->nullable()->index('score_id');
			$table->dateTime('applied_tag_created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_nps_tags');
	}

}
