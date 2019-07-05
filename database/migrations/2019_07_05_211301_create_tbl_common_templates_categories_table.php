<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCommonTemplatesCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_common_templates_categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('category_name', 200)->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('module_name', 55)->nullable();
			$table->boolean('status')->default(1);
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
		Schema::drop('tbl_common_templates_categories');
	}

}
