<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_reviews', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('unique_review_key', 100)->nullable();
                        $table->string('review_type', 45)->nullable()->default('product')->comment('"product", "service", "site"');
			$table->string('campaign_id', 45)->nullable()->index('campaign_id');
			$table->integer('product_id')->nullable();
			$table->string('review_title')->nullable();
			$table->integer('user_id')->nullable()->index('user_id');
			$table->text('comment_text')->nullable();
			$table->string('comment_video')->nullable()->index('comment_video_id');
			$table->text('media_url')->nullable();
                        $table->text('croped_image_url')->nullable();
			$table->boolean('ratings');
			$table->text('pro_review', 65535);
			$table->text('cons_review', 65535);
			$table->integer('allow_show_name')->default(1);
			$table->integer('inviter_id')->nullable()->comment('tbl_brandboost_events.id');
			$table->integer('recvalue')->nullable();
			$table->boolean('status')->nullable()->default(2)->comment('2=pending, 0=disapproved, 1=approved');
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
		Schema::drop('tbl_reviews');
	}

}
