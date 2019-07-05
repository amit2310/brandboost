<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUsersTeamTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_users_team', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('team_role_id')->index('team_role_id');
			$table->integer('parent_user_id')->index('parent_user_id');
			$table->string('firstname', 45)->nullable()->index('firstname');
			$table->string('lastname', 45)->nullable()->index('lastname');
			$table->string('email', 45)->nullable()->index('email');
			$table->string('password', 100);
			$table->string('avatar')->nullable();
			$table->string('ext_code', 20)->nullable();
			$table->string('ext_country_code', 100)->nullable();
			$table->string('mobile', 20)->nullable();
			$table->string('gender');
			$table->string('address')->nullable();
			$table->string('address2')->nullable();
			$table->string('city', 100)->nullable();
			$table->string('state', 100)->nullable();
			$table->string('country', 100)->nullable();
			$table->string('zip_code', 50);
			$table->text('socialProfile', 65535);
			$table->string('tagID');
			$table->boolean('status')->nullable();
			$table->dateTime('created')->nullable();
			$table->integer('web_chat')->default(0);
			$table->integer('sms_chat')->default(0);
			$table->string('bb_number');
			$table->text('contact_sid', 65535);
			$table->string('twilio_cost');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_users_team');
	}

}
