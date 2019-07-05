<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUserActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_user_activities', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('module_name', 100)->nullable();
			$table->integer('module_account_id')->nullable();
			$table->string('event_type', 55)->nullable()->index('event_type');
			$table->string('action_name', 55)->nullable();
			$table->integer('list_id')->nullable()->index('list_id');
			$table->integer('automation_id')->nullable();
			$table->integer('brandboost_id')->nullable()->index('brandboost_id');
			$table->integer('widget_id')->nullable();
			$table->integer('campaign_id')->nullable()->index('campaign_id');
			$table->integer('inviter_id')->nullable()->index('inviter_id');
			$table->integer('subscriber_id')->nullable()->index('subscriber_id');
			$table->integer('feedback_id')->nullable()->index('feedback_id');
			$table->text('activity_message')->nullable();
			$table->dateTime('activity_created')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_user_activities');
	}

}
