<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationsEmailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automations_emails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->index('user_id');
			$table->string('automation_type', 55);
			$table->string('title', 100)->nullable();
			$table->text('description', 65535);
			$table->string('email_type', 50)->default('automation');
			$table->string('current_state', 55)->nullable()->comment('step on which campaign stored as a draft');
			$table->string('audience_type', 11)->default('lists');
			$table->string('sending_method', 55)->default('normal');
			$table->string('status', 10)->default('active');
			$table->dateTime('created')->nullable();
			$table->boolean('deleted')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_automations_emails');
	}

}
