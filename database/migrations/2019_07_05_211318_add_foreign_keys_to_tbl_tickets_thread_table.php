<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblTicketsThreadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_tickets_thread', function(Blueprint $table)
		{
			$table->foreign('ticket_id', 'fk_tbl_tickets_thread')->references('id')->on('tbl_tickets')->onUpdate('NO ACTION')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_tickets_thread', function(Blueprint $table)
		{
			$table->dropForeign('fk_tbl_tickets_thread');
		});
	}

}
