<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReviewsQuestionNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_reviews_question_notes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('question_id')->index('question_id');
			$table->integer('user_id')->index('user_id');
			$table->integer('brandboost_id')->index('brandboost_id');
			$table->text('notes', 65535)->nullable();
			$table->boolean('status')->default(1);
			$table->dateTime('updated')->nullable();
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
		Schema::drop('tbl_reviews_question_notes');
	}

}
