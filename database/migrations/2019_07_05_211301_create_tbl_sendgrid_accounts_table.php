<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblSendgridAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_sendgrid_accounts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('sg_email')->nullable();
			$table->string('sg_username')->nullable();
			$table->string('sg_password', 45)->nullable();
			$table->string('sg_ip', 45)->nullable();
			$table->string('status', 45)->nullable()->default('1');
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
		Schema::drop('tbl_sendgrid_accounts');
	}

}
