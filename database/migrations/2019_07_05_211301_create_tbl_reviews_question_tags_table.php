<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReviewsQuestionTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_reviews_question_tags', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('tag_id')->nullable();
			$table->integer('question_id')->nullable()->index('question_id');
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
		Schema::drop('tbl_reviews_question_tags');
	}

}
