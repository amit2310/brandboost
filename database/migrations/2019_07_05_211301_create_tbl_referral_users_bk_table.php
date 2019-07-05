<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralUsersBkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_users_bk', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('affiliateid')->nullable();
			$table->string('account_id')->nullable();
			$table->integer('subscriber_id')->nullable();
			$table->string('cb_contact_id', 55)->nullable();
			$table->string('subscription_id', 55)->nullable();
			$table->integer('infusion_user_id')->index('infusion_user_id');
			$table->string('firstname', 45)->nullable();
			$table->string('lastname', 45)->nullable();
			$table->string('email', 45)->nullable();
			$table->string('password', 100);
			$table->string('avatar', 45)->nullable()->default('avatar_image.png');
			$table->string('ext_code', 20)->nullable();
			$table->string('ext_country_code', 100)->nullable();
			$table->string('mobile', 20)->nullable();
			$table->string('address')->nullable();
			$table->string('address2')->nullable();
			$table->string('city', 100)->nullable();
			$table->string('state', 100)->nullable();
			$table->string('country', 100)->nullable();
			$table->string('zip_code', 50);
			$table->integer('user_role')->nullable()->comment('1 = Admin, 2 = Users, 3 = Customer');
			$table->boolean('status')->nullable()->default(1);
			$table->integer('infusion_cc_id')->nullable()->index('infusion_cc_id');
			$table->string('chargebee_cc_id', 55)->nullable();
			$table->integer('cc_last_four')->nullable();
			$table->integer('login_counter_lu')->default(0);
			$table->integer('login_counter_au')->default(0);
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
		Schema::drop('tbl_referral_users_bk');
	}

}
