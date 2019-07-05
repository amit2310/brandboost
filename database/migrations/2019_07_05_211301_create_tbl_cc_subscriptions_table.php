<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCcSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_cc_subscriptions', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('subscription_id', 55)->nullable();
			$table->string('customer_id', 55)->nullable();
			$table->string('plan_id', 55)->nullable();
			$table->string('billing_period', 55)->nullable();
			$table->string('billing_period_unit', 55)->nullable();
			$table->string('subscription_status', 55)->nullable();
			$table->string('trial_start', 55)->nullable();
			$table->string('trial_end', 55)->nullable();
			$table->string('next_billing_at', 55)->nullable();
			$table->string('created_at', 55)->nullable();
			$table->string('started_at', 55)->nullable();
			$table->string('updated_at', 55)->nullable();
			$table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_cc_subscriptions');
	}

}
