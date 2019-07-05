<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUserMembershipTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_user_membership', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('membership_id')->nullable()->index('membership_id');
			$table->integer('user_id')->nullable()->index('user_id');
			$table->integer('infusion_subscription_id')->nullable()->index('infusion_subscription_id');
			$table->integer('status')->nullable();
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
		Schema::drop('tbl_user_membership');
	}

}
