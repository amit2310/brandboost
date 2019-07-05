<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSubscribersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_subscribers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->bigInteger('user_id')->nullable()->index('user_id');
			$table->integer('owner_id')->nullable();
			$table->string('source', 100);
			$table->string('firstname', 100)->nullable();
			$table->string('lastname', 100)->nullable();
			$table->string('email', 100)->nullable()->index('email');
			$table->string('phone', 50)->nullable()->index('phone');
			$table->string('gender', 10);
			$table->string('country_code', 10)->nullable();
			$table->string('cityName', 100);
			$table->string('stateName', 100);
			$table->string('zipCode', 10);
			$table->text('socialProfile', 65535);
			$table->text('facebook_profile', 65535)->nullable();
			$table->text('twitter_profile', 65535)->nullable();
			$table->text('linkedin_profile', 65535)->nullable();
			$table->text('instagram_profile', 65535)->nullable();
			$table->string('tagID', 256);
			$table->dateTime('created')->nullable();
			$table->dateTime('updated')->nullable();
			$table->boolean('status')->default(1)->comment('1 = Subcriber, 0 = Unsubcriber, 2 = Archive');
			$table->integer('is_email_verified')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_subscribers');
	}

}
