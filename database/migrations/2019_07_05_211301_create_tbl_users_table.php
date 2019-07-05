<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('cb_contact_id', 55)->nullable();
			$table->string('subscription_id', 55)->nullable();
			$table->string('topup_subscription_id', 55)->nullable();
			$table->integer('infusion_user_id')->index('infusion_user_id');
			$table->string('firstname', 45)->nullable();
			$table->string('lastname', 45)->nullable();
			$table->string('email', 45)->nullable();
			$table->string('password', 100);
			$table->string('avatar')->nullable();
			$table->string('ext_code', 20)->nullable();
			$table->string('ext_country_code', 100)->nullable();
			$table->string('mobile', 20)->nullable();
			$table->string('address')->nullable();
			$table->string('address2')->nullable();
			$table->string('city', 100)->nullable();
			$table->string('state', 100)->nullable();
			$table->string('country', 100)->nullable();
			$table->string('zip_code', 50);
			$table->string('website');
			$table->integer('user_role')->nullable()->comment('1 = Admin, 2 = Users, 3 = Customer');
			$table->boolean('status')->nullable();
			$table->integer('infusion_cc_id')->nullable()->index('infusion_cc_id');
			$table->string('chargebee_cc_id', 55)->nullable();
			$table->integer('cc_last_four')->nullable();
			$table->integer('cc_exp_month')->nullable();
			$table->integer('cc_exp_year')->nullable();
			$table->integer('login_counter_lu')->default(0);
			$table->integer('login_counter_au')->default(0);
			$table->string('company_name', 55);
			$table->text('company_description');
			$table->string('company_logo', 55)->default('avatar_image.png');
			$table->string('company_type')->nullable();
			$table->string('company_operate_scope', 22)->nullable();
			$table->integer('company_working_hours')->default(8);
			$table->string('company_address')->nullable();
			$table->string('company_phone', 55)->nullable();
			$table->string('company_country', 55)->nullable();
			$table->string('company_website')->nullable();
			$table->integer('business_address_dppa')->nullable()->default(1);
			$table->integer('phone_no_dppa')->default(1);
			$table->integer('website_dppa')->default(1);
			$table->text('company_seo_keywords', 65535)->nullable();
			$table->string('social_facebook')->nullable();
			$table->string('social_instagram')->nullable();
			$table->string('social_twitter')->nullable();
			$table->string('social_linkedin')->nullable();
			$table->string('public_profile_link')->nullable();
			$table->string('public_publish_page', 11)->nullable();
			$table->string('wh_start_week', 11)->nullable();
			$table->string('wh_start_day', 11)->nullable();
			$table->string('wh_end_day', 11)->nullable();
			$table->string('wh_start_day_minutes', 11)->default('00');
			$table->string('wh_end_day_minutes', 11)->default('00');
			$table->string('timezone', 55)->nullable();
			$table->string('date_format', 11)->nullable();
			$table->string('time_format', 11)->nullable();
			$table->string('review_alias', 55)->nullable();
			$table->string('reviewer_alias', 55)->nullable();
			$table->string('seller_alias', 55)->nullable();
			$table->integer('receive_newsletter')->default(1);
			$table->string('language', 55);
			$table->string('currency', 11);
			$table->dateTime('updated')->nullable();
			$table->integer('receive_debug_notification')->default(0);
			$table->dateTime('created')->nullable();
			$table->integer('login_status')->default(0);
			$table->dateTime('last_login');
			$table->integer('deleted_status')->default(0)->comment('1 = Deleted, 0 = Not deleted');
			$table->integer('phone_display')->default(1);
			$table->integer('website_display')->default(1);
			$table->integer('email_noti')->default(1);
			$table->integer('pass_ex_noti')->default(1);
			$table->integer('new_msg_noti')->default(1);
			$table->integer('new_task_noti')->default(1);
			$table->integer('new_contact_req_noti')->default(1);
			$table->string('billing_firstname', 100);
			$table->string('billing_lastname', 100);
			$table->string('billing_address1');
			$table->string('billing_address2');
			$table->string('billing_city', 100);
			$table->string('billing_country', 100);
			$table->string('billing_state', 100);
			$table->string('billing_zipcode', 100);
			$table->string('billing_phone', 100);
			$table->integer('s3_bucket')->default(0);
			$table->string('s3_allow_size')->nullable()->default('1024');
			$table->string('s3_used_size')->nullable();
			$table->string('s3_alert', 25)->nullable();
			$table->integer('credit_interval')->default(0);
			$table->string('remaining_credit')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_users');
	}

}
