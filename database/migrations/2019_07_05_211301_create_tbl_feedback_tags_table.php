<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblFeedbackTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_feedback_tags', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('tag_id')->nullable();
			$table->integer('feedback_id')->nullable();
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
		Schema::drop('tbl_feedback_tags');
	}

}
