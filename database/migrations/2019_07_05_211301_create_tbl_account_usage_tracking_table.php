<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAccountUsageTrackingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_account_usage_tracking', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('usage_type', 11)->nullable();
			$table->string('direction', 11)->nullable();
			$table->boolean('segment')->nullable();
			$table->string('spend_to')->nullable();
			$table->string('spend_from')->nullable();
			$table->string('module_name')->nullable();
			$table->string('module_unit_id', 11)->nullable();
			$table->text('content')->nullable();
			$table->string('opening_balance', 11)->nullable();
			$table->string('balance_deducted', 11)->nullable();
			$table->string('closing_balance', 11)->nullable();
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
		Schema::drop('tbl_account_usage_tracking');
	}

}
