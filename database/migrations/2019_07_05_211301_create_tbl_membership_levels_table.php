<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblMembershipLevelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_membership_levels', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('type', 11);
			$table->string('level_name', 45)->nullable();
			$table->string('topup_fee', 45)->nullable();
			$table->string('monthly_subscription_fee', 45);
			$table->string('yearly_subscription_fee', 45);
			$table->string('bi_yearly_subscription_fee', 45)->nullable();
			$table->string('free_trial_days', 45)->nullable();
			$table->integer('email_limit')->nullable();
			$table->integer('sms_limit')->nullable();
			$table->integer('text_review_limit')->nullable();
			$table->integer('video_review_limit')->nullable();
			$table->string('social_invite_sources', 45)->nullable();
			$table->boolean('custom_addons')->nullable();
			$table->integer('topup_email_limit');
			$table->integer('topup_sms_limit');
			$table->string('monthly_plan_id')->nullable();
			$table->string('yearly_plan_id')->nullable();
			$table->string('topup_plan_id')->nullable();
			$table->integer('infusion_product_id')->nullable()->index('infusion_product_id');
			$table->integer('monthly_infusion_product_id');
			$table->integer('yearly_infusion_product_id');
			$table->integer('monthly_subscription_plan_id')->nullable()->index('subscription_plan_id');
			$table->integer('yearly_subscription_plan_id');
			$table->text('description')->nullable();
			$table->integer('status')->nullable()->default(1);
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
		Schema::drop('tbl_membership_levels');
	}

}
