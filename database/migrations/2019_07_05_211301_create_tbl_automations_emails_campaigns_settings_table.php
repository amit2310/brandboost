<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationsEmailsCampaignsSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automations_emails_campaigns_settings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('campaign_id')->nullable();
			$table->integer('text_version_email')->nullable();
			$table->integer('enable_mobile_responsiveness')->nullable();
			$table->integer('read_tracking')->nullable();
			$table->integer('link_tracking')->nullable();
			$table->integer('reply_tracking')->nullable();
			$table->integer('google_analytics')->nullable();
			$table->integer('campaign_archives')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_automations_emails_campaigns_settings');
	}

}
