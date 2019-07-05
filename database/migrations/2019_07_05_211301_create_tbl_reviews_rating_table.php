<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReviewsRatingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_reviews_rating', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('review_id')->nullable()->index('review_id');
			$table->integer('user_id')->nullable()->index('user_id');
			$table->boolean('rating_count')->nullable()->index('rating_count');
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
		Schema::drop('tbl_reviews_rating');
	}

}
