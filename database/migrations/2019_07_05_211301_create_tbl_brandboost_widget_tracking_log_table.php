<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBrandboostWidgetTrackingLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_brandboost_widget_tracking_log', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('widget_id')->nullable()->index('widget_id');
			$table->integer('owner_id')->nullable()->index('owner_id');
			$table->integer('review_id');
			$table->integer('question_id');
			$table->string('widget_type', 55)->nullable()->index('widget_type');
			$table->integer('brandboost_id')->nullable()->index('brandboost_id');
			$table->string('track_type', 55)->nullable()->index('track_type')->comment('view/click/comment/helpful');
			$table->string('section_type', 55)->nullable()->index('section_type')->comment('review/question');
			$table->string('ip_address')->nullable()->index('ip_address');
			$table->string('platform')->nullable();
			$table->string('platform_device')->nullable();
			$table->string('browser')->nullable();
			$table->text('useragent', 65535)->nullable();
			$table->string('country')->nullable();
			$table->string('countryCode')->nullable();
			$table->string('region')->nullable();
			$table->string('city')->nullable();
			$table->string('longitude')->nullable();
			$table->string('latitude')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_brandboost_widget_tracking_log');
	}

}
