<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblGalleryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_gallery', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable();
			$table->integer('team_id')->nullable();
			$table->text('reviews_id', 65535)->nullable();
			$table->string('hashcode', 100)->nullable();
			$table->string('gallery_type', 100)->nullable();
			$table->string('gallery_design_type', 50)->nullable()->default('onerow');
			$table->string('image_size', 100)->nullable()->default('medium');
			$table->boolean('border_thickness')->nullable()->default(5);
			$table->boolean('allow_border_shadow')->nullable()->default(0);
			$table->string('name')->nullable();
			$table->text('description')->nullable();
			$table->boolean('allow_title')->nullable()->default(1);
			$table->boolean('allow_arrow')->nullable()->default(1);
			$table->boolean('allow_ratings')->nullable()->default(1);
			$table->boolean('allow_widget_bgcolor')->nullable()->default(1);
			$table->text('gallery_logo', 65535)->nullable();
			$table->string('bg_color_type', 100)->nullable();
			$table->string('gradient_color', 100)->nullable();
			$table->string('solid_color', 100)->nullable();
			$table->string('gradient_start_color', 100)->nullable();
			$table->string('gradient_end_color', 100)->nullable();
			$table->string('gradient_orientation', 100)->nullable();
			$table->boolean('status')->nullable()->default(1);
			$table->dateTime('created')->nullable();
			$table->boolean('deleted')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_gallery');
	}

}
