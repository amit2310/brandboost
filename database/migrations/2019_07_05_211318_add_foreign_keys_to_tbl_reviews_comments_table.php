<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblReviewsCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_reviews_comments', function(Blueprint $table)
		{
			$table->foreign('review_id', 'fk_tbl_reviews_comments')->references('id')->on('tbl_reviews')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_reviews_comments', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_reviews_comments');
		});
	}

}
