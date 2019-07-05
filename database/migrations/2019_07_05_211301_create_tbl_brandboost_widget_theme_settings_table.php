<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostWidgetThemeSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_widget_theme_settings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('brandboost_widget_id')->nullable();
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('widget_theme_title')->nullable();
			$table->boolean('allow_comments')->nullable();
			$table->boolean('allow_video_reviews')->nullable();
			$table->boolean('allow_helpful_feedback')->nullable();
			$table->boolean('allow_live_reading_review')->nullable();
			$table->boolean('allow_comment_ratings')->nullable();
			$table->boolean('allow_review_timestamp')->nullable();
			$table->boolean('min_ratings_display')->nullable();
			$table->integer('num_of_review')->nullable();
			$table->integer('often_bb_display')->nullable();
			$table->boolean('status')->nullable()->default(1);
			$table->string('created', 50)->nullable();
			$table->string('header_color')->nullable();
			$table->string('header_custom_color1')->nullable();
			$table->string('header_custom_color2')->nullable();
			$table->string('header_solid_color')->nullable();
			$table->integer('header_color_fix')->nullable();
			$table->integer('header_color_custom')->nullable();
			$table->integer('header_color_solid')->nullable();
			$table->string('rating_color', 100)->nullable();
			$table->string('rating_custom_color1', 100)->nullable();
			$table->string('rating_custom_color2', 100)->nullable();
			$table->string('rating_solid_color', 100)->nullable();
			$table->integer('rating_color_fix')->nullable();
			$table->string('widget_font_color', 20)->nullable();
			$table->string('widget_border_color', 100)->nullable();
			$table->string('widget_position', 20)->nullable();
			$table->string('color_orientation', 100)->default('to bottom');
			$table->integer('widget_themes')->nullable();
			$table->integer('allow_branding')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_brandboost_widget_theme_settings');
	}

}
