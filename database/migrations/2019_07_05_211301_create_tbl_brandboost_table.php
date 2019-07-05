<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('review_type', 11)->comment('On Site or Off Site');
			$table->string('hashcode', 50);
			$table->integer('user_id')->index('user_id');
			$table->string('brand_title');
			$table->text('brand_desc');
			$table->text('brand_img');
			$table->string('logo_img');
			$table->boolean('allow_comments')->default(1);
			$table->boolean('allow_video_reviews')->default(0);
			$table->boolean('allow_helpful_feedback')->default(1);
			$table->boolean('allow_live_reading_review')->default(1);
			$table->boolean('allow_comment_ratings')->default(1);
			$table->boolean('allow_review_timestamp')->default(1);
			$table->boolean('allow_pros_cons')->default(1);
			$table->string('bg_color', 50);
			$table->string('text_color', 50);
			$table->boolean('min_ratings_display')->default(0);
			$table->text('exclude_pages');
			$table->string('offsite_ids');
			$table->string('reward_value');
			$table->string('country_code', 10);
			$table->string('country_ext', 10);
			$table->integer('reward_type_id');
			$table->string('receive_reward_type');
			$table->text('offsites_links', 65535);
			$table->string('widget_type')->default('vpw');
			$table->string('domain_name');
			$table->integer('num_of_review');
			$table->integer('often_bb_display');
			$table->boolean('pro_cons')->default(0);
			$table->string('link_expire_review', 11)->nullable();
			$table->string('link_expire_custom', 100)->nullable();
			$table->boolean('status');
			$table->boolean('delete_status')->default(0);
			$table->string('created', 50);
			$table->boolean('preview_allow_comments');
			$table->boolean('previewallow_video_reviews');
			$table->boolean('preview_allow_helpful_feedback');
			$table->boolean('preview_allow_live_reading_review');
			$table->boolean('preview_allow_comment_ratings');
			$table->boolean('preview_allow_review_timestamp');
			$table->boolean('preview_allow_pros_cons');
			$table->string('preview_bg_color', 50);
			$table->string('preview_text_color', 50);
			$table->string('header_color')->default('blue');
			$table->string('header_custom_color1');
			$table->string('header_custom_color2');
			$table->string('header_solid_color');
			$table->integer('header_color_fix')->default(1);
			$table->integer('header_color_custom')->default(0);
			$table->integer('header_color_solid')->default(0);
			$table->string('company_logo');
			$table->integer('allow_branding')->default(1);
			$table->integer('notification')->default(0);
			$table->integer('company_info')->default(1);
			$table->string('company_info_name');
			$table->text('company_info_description', 65535);
			$table->text('store_url', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_brandboost');
	}

}
