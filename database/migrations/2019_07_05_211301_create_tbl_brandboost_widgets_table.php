<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostWidgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_widgets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('brandboost_id')->nullable();
			$table->string('review_type', 11)->nullable()->comment('On Site or Off Site');
			$table->string('hashcode', 50)->nullable();
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('widget_title')->nullable();
			$table->text('widget_desc')->nullable();
			$table->string('widget_img')->nullable();
			$table->string('brand_title')->nullable();
			$table->text('brand_desc')->nullable();
			$table->string('logo_img')->nullable();
			$table->boolean('allow_comments')->default(1);
			$table->boolean('allow_video_reviews')->default(0);
			$table->boolean('allow_helpful_feedback')->default(1);
			$table->boolean('allow_live_reading_review')->default(0);
			$table->boolean('allow_comment_ratings')->default(1);
			$table->boolean('allow_review_timestamp')->default(1);
			$table->boolean('allow_pros_cons')->default(0);
			$table->string('bg_color', 50)->nullable();
			$table->string('text_color', 50)->nullable();
			$table->boolean('min_ratings_display')->default(0);
			$table->text('exclude_pages')->nullable();
			$table->string('offsite_ids')->nullable();
			$table->string('reward_value')->nullable();
			$table->string('country_code', 10)->nullable();
			$table->string('country_ext', 10)->nullable();
			$table->integer('reward_type_id')->nullable();
			$table->string('receive_reward_type')->nullable();
			$table->text('offsites_links', 65535)->nullable();
			$table->string('widget_type')->nullable();
			$table->string('domain_name')->nullable();
			$table->integer('num_of_review')->nullable();
			$table->integer('often_bb_display')->nullable();
			$table->boolean('pro_cons')->default(0);
			$table->string('link_expire_review', 11)->nullable();
			$table->string('link_expire_custom', 100)->nullable();
			$table->boolean('status')->nullable();
			$table->boolean('delete_status')->default(0);
			$table->string('created', 50)->nullable();
			$table->boolean('preview_allow_comments')->nullable();
			$table->boolean('previewallow_video_reviews')->nullable();
			$table->boolean('preview_allow_helpful_feedback')->nullable();
			$table->boolean('preview_allow_live_reading_review')->nullable();
			$table->boolean('preview_allow_comment_ratings')->nullable();
			$table->boolean('preview_allow_review_timestamp')->nullable();
			$table->boolean('preview_allow_pros_cons')->nullable();
			$table->string('preview_bg_color', 50)->nullable();
			$table->string('preview_text_color', 50)->nullable();
			$table->string('header_color')->default('white');
			$table->string('header_custom_color1')->nullable();
			$table->string('header_custom_color2')->nullable();
			$table->string('header_solid_color')->nullable();
			$table->integer('header_color_fix')->default(1);
			$table->integer('header_color_custom')->default(0);
			$table->integer('header_color_solid')->default(0);
			$table->string('rating_color', 100)->default('#ffcb65');
			$table->string('rating_custom_color1', 100)->default('#ffcb65');
			$table->string('rating_custom_color2', 100)->default('#ffcb65');
			$table->string('rating_solid_color', 100)->default('#ffcb65');
			$table->integer('rating_color_fix')->default(1);
			$table->string('widget_font_color', 20)->default('#1d2129');
			$table->string('widget_border_color', 100)->default('#f4f6fa');
			$table->string('widget_position', 20)->default('');
			$table->integer('widget_themes');
			$table->integer('alternative_design')->default(0);
			$table->integer('allow_campaign_name')->default(1);
			$table->string('icon_type', 20)->default('default');
			$table->string('color_orientation', 100)->default('to bottom');
			$table->string('reviews_order', 50)->default('all');
			$table->string('reviews_order_by', 50)->default('all');
			$table->string('company_logo')->nullable();
			$table->integer('allow_branding')->default(1);
			$table->integer('notification')->default(0);
			$table->integer('company_info')->default(0);
			$table->string('company_info_name')->nullable();
			$table->text('company_info_description', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_brandboost_widgets');
	}

}
