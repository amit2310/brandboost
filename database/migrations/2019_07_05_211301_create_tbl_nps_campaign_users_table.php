<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblNpsCampaignUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_nps_campaign_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('nps_id')->index('nps_id');
			$table->bigInteger('user_id')->index('user_id');
			$table->integer('subscriber_id')->nullable()->index('subscriber_id');
			$table->dateTime('created');
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
		Schema::drop('tbl_nps_campaign_users');
	}

}
