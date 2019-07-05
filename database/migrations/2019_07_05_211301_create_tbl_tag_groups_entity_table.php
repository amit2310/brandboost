<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTagGroupsEntityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_tag_groups_entity', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('group_id')->nullable();
			$table->string('tag_name')->nullable();
			$table->dateTime('tag_created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_tag_groups_entity');
	}

}
