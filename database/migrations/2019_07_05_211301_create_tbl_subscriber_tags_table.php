<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSubscriberTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_subscriber_tags', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('tag_id')->nullable();
			$table->integer('subscriber_id')->nullable()->index('subscriber_id');
			$table->dateTime('applied_tag_created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_subscriber_tags');
	}

}
