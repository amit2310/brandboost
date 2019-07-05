<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblInvoicesJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_invoices_jobs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('infusion_job_id')->nullable()->index('job_id');
			$table->integer('infusion_user_id')->nullable()->index('infusion_user_id');
			$table->string('job_title', 45)->nullable();
			$table->dateTime('due_date')->nullable();
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
		Schema::drop('tbl_invoices_jobs');
	}

}
