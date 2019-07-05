<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostFaqsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_faqs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_id');
			$table->string('question_title')->nullable();
			$table->text('media_url', 65535)->nullable();
			$table->string('question')->nullable();
			$table->text('answer', 65535)->nullable();
			$table->boolean('status')->default(2);
			$table->dateTime('created')->nullable();
			$table->dateTime('updated')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_brandboost_faqs');
	}

}
