<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblCronLockTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_cron_lock', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('cron_name', 55)->nullable();
			$table->integer('locked')->nullable();
			$table->dateTime('last_run_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_cron_lock');
	}

}
