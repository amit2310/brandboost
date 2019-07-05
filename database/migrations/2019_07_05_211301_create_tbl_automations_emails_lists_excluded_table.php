<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationsEmailsListsExcludedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automations_emails_lists_excluded', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('automation_id')->unsigned()->nullable()->index('automation_id');
			$table->integer('list_id')->unsigned()->nullable()->index('list_id');
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
		Schema::drop('tbl_automations_emails_lists_excluded');
	}

}
