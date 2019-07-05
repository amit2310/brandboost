<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSiteReviewsHelpfulTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_site_reviews_helpful', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('review_id')->nullable()->index('review_id');
			$table->integer('helpful_yes')->nullable();
			$table->integer('helpful_no')->nullable();
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('ip')->nullable();
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
		Schema::drop('tbl_site_reviews_helpful');
	}

}
