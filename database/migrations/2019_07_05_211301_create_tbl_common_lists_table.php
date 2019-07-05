<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCommonListsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_common_lists', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('list_name')->nullable();
			$table->text('description', 65535);
			$table->string('list_type', 20)->default('list');
			$table->boolean('delete_status')->default(0);
			$table->string('status', 10)->default('active');
			$table->dateTime('list_created')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_common_lists');
	}

}
