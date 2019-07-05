<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCommentLikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_comment_likes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('comment_id')->nullable()->index('review_id');
			$table->integer('status');
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
		Schema::drop('tbl_comment_likes');
	}

}
