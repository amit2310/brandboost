<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReviewsOffsiteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_reviews_offsite', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('brandboost_id');
			$table->string('name', 100);
			$table->text('review_content');
			$table->string('ratings', 50);
			$table->string('source', 50);
			$table->text('author_url', 65535);
			$table->text('profile_photo_url', 65535);
			$table->string('created', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_reviews_offsite');
	}

}
