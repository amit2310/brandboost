<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandConfigurationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brand_configurations', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('brandboost_id');
			$table->text('company_logo', 65535);
			$table->text('company_header_logo', 65535);
			$table->integer('avatar')->default(1);
			$table->text('company_description', 65535);
			$table->integer('services')->default(1);
			$table->integer('contact_button')->default(1);
			$table->integer('contact_info')->default(1);
			$table->integer('socials')->default(1);
			$table->integer('customer_experiance')->default(1);
			$table->boolean('area_type')->nullable()->default(0);
			$table->string('about_company_position', 225)->default('left');
			$table->string('review_list_position', 225)->default('right');
			$table->string('rating', 10)->default('on');
			$table->integer('chat_widget');
			$table->integer('referral_widget');
			$table->integer('company_info')->default(1);
			$table->string('company_info_name');
			$table->text('company_info_description', 65535);
			$table->string('header_color', 225)->default('blue');
			$table->string('header_custom_color1', 225);
			$table->string('header_custom_color2');
			$table->string('header_solid_color', 20);
			$table->integer('header_color_fix')->default(1);
			$table->integer('header_color_custom')->default(0);
			$table->integer('header_color_solid')->default(0);
			$table->string('color_orientation_top', 55);
			$table->string('color_orientation_full', 55);
			$table->text('campaign_ids', 65535);
			$table->text('multi_campaign', 65535);
			$table->integer('theme_id');
			$table->integer('template_style');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_brand_configurations');
	}

}
