<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReviewsQuestionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_reviews_question', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('review_id');
			$table->integer('user_id')->nullable();
			$table->integer('campaign_id')->nullable();
			$table->string('question_title')->nullable();
			$table->text('media_url', 65535)->nullable();
			$table->string('question')->nullable();
			$table->text('answer', 65535);
			$table->integer('allow_show_name')->default(1);
			$table->boolean('status')->default(2);
			$table->dateTime('created')->nullable();
			$table->dateTime('updated')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_reviews_question');
	}

}
