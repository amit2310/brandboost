<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationUsersExcludedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automation_users_excluded', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('automation_id')->nullable();
			$table->integer('list_id')->index('brandboost_id');
			$table->bigInteger('user_id')->nullable()->index('user_id');
			$table->integer('subscriber_id')->nullable();
			$table->string('firstname', 100);
			$table->string('lastname', 100);
			$table->string('email', 100)->index('email');
			$table->string('phone', 50)->nullable();
			$table->dateTime('created');
			$table->dateTime('updated')->nullable();
			$table->boolean('status')->default(1)->comment('1 = Subcriber, 0 = Unsubcriber');
			$table->integer('is_email_verified')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_automation_users_excluded');
	}

}
