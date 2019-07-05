<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationsEmailsCampaignsSegmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automations_emails_campaigns_segment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('auto_event_id')->unsigned()->index('auto_event_id');
			$table->integer('campaign_id')->unsigned()->index('campaign_id');
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
		Schema::drop('tbl_automations_emails_campaigns_segment');
	}

}
