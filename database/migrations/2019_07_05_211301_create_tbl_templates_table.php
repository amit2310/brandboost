<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_templates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('slug');
			$table->string('title');
			$table->text('subject', 65535);
			$table->text('template');
			$table->boolean('status')->default(1);
			$table->string('template_type', 200);
			$table->dateTime('created');
			$table->dateTime('updated')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_templates');
	}

}
