<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandThemesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brand_themes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('brand_theme_title', 55);
			$table->string('header_color', 225)->default('blue');
			$table->string('header_custom_color1', 225);
			$table->string('header_custom_color2');
			$table->string('header_solid_color', 20);
			$table->integer('header_color_fix')->default(1);
			$table->integer('header_color_custom')->default(0);
			$table->integer('header_color_solid')->default(0);
			$table->string('color_orientation_top', 55);
			$table->string('color_orientation_full', 55);
			$table->integer('area_type')->default(0);
			$table->text('default_logo', 65535);
			$table->text('default_header_logo', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_brand_themes');
	}

}
