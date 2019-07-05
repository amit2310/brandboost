<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReviewsAnswersHelpfulTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_reviews_answers_helpful', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('answer_id');
			$table->integer('helpful_yes');
			$table->integer('helpful_no');
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('ip');
			$table->dateTime('created')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_reviews_answers_helpful');
	}

}
