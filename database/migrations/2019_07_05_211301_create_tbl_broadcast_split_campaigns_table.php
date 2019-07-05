<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblBroadcastSplitCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_broadcast_split_campaigns', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('split_test_id')->nullable()->default(0)->index('split_test_id');
			$table->integer('broadcast_id')->default(0)->index('broadcast_id');
			$table->string('variation_name')->nullable();
			$table->bigInteger('split_load')->nullable()->default(0);
			$table->integer('event_id')->nullable()->index('user_id')->comment('tbl_brandboost_events.id');
			$table->string('content_type', 10)->nullable()->comment('Regular or Plain Text');
			$table->string('campaign_type', 10)->nullable()->comment('Email or SMS');
			$table->text('heading', 65535)->nullable();
			$table->text('introduction', 65535)->nullable();
			$table->text('greeting', 65535)->nullable();
			$table->text('name', 65535)->nullable();
			$table->text('subject', 65535)->nullable();
			$table->text('preheader', 65535)->nullable();
			$table->text('description', 65535)->nullable();
			$table->text('html')->nullable();
			$table->text('stripo_html')->nullable();
			$table->text('stripo_css')->nullable();
			$table->text('stripo_compiled_html')->nullable();
			$table->text('from_email', 65535)->nullable();
			$table->text('from_name', 65535)->nullable();
			$table->text('reply_to', 65535)->nullable();
			$table->string('status', 10)->default('0')->comment('0- New, 1-Queue,2-Sending,3-Complete');
			$table->boolean('pause_resume_stop_status')->default(2)->comment('0- Stop, 1-Pause, 2-Resume');
			$table->boolean('sign_dkim')->nullable();
			$table->boolean('track_open')->nullable();
			$table->boolean('track_click')->nullable();
			$table->integer('resend')->nullable();
			$table->dateTime('run_at')->nullable();
			$table->dateTime('delivery_at')->nullable();
			$table->string('created', 50)->nullable();
			$table->boolean('template_source')->nullable();
			$table->boolean('delete_status')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_broadcast_split_campaigns');
	}

}
