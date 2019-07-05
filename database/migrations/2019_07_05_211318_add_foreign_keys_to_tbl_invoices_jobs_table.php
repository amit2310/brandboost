<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblInvoicesJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_invoices_jobs', function(Blueprint $table)
		{
			$table->foreign('infusion_job_id', 'fk_tbl_invoices_jobs')->references('infusion_job_id')->on('tbl_invoices')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_invoices_jobs', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_invoices_jobs');
		});
	}

}
