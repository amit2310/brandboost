<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostCampaignsSegmentsExcludeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_campaigns_segments_exclude', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('user_id');
			$table->integer('brandboost_id')->nullable()->index('brandboost_id');
			$table->integer('segment_id')->index('segment_id');
			$table->boolean('status')->nullable()->default(1);
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
		Schema::drop('tbl_brandboost_campaigns_segments_exclude');
	}

}
