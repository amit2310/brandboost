<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblGalleryWidgetSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_gallery_widget_settings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('gallery_id')->nullable();
			$table->boolean('allow_title')->nullable()->default(1);
			$table->boolean('allow_arrow')->nullable()->default(1);
			$table->boolean('allow_ratings')->nullable()->default(1);
			$table->string('gallery_logo')->nullable();
			$table->string('bg_color_type', 100)->nullable();
			$table->string('gradient_color', 100)->nullable();
			$table->string('solid_color', 100)->nullable();
			$table->string('gradient_start_color', 100)->nullable();
			$table->string('gradient_end_color', 100)->nullable();
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
		Schema::drop('tbl_gallery_widget_settings');
	}

}
