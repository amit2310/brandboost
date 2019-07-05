<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSiteReviewsCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_site_reviews_comments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('review_id')->nullable()->index('review_id');
			$table->string('user_id', 45)->nullable()->index('user_id');
			$table->integer('parent_comment_id')->nullable()->index('parent_comment_id');
			$table->text('content')->nullable();
			$table->boolean('status')->nullable()->default(2)->comment('1 = Active, 0 = Disapproved, 2 = pending');
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
		Schema::drop('tbl_site_reviews_comments');
	}

}
