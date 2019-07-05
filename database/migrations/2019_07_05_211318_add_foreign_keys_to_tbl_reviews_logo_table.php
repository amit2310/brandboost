<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblReviewsLogoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_reviews_logo', function(Blueprint $table)
		{
			$table->foreign('review_id', 'fk_tbl_reviews_logo')->references('id')->on('tbl_reviews')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_reviews_logo', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_reviews_logo');
		});
	}

}
