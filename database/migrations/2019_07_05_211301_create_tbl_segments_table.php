<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSegmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_segments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('segment_name')->nullable();
			$table->text('segment_desc', 65535)->nullable();
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('source_campaign_id', 55)->nullable();
			$table->string('source_campaign_type', 55)->nullable();
			$table->string('source_segment_type', 55)->nullable();
			$table->string('source_sending_method', 55)->default('normal')->comment('normal/split');
			$table->string('source_module_name', 55)->nullable();
			$table->string('source_event_id', 55)->nullable();
			$table->integer('status')->default(1);
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
		Schema::drop('tbl_segments');
	}

}
