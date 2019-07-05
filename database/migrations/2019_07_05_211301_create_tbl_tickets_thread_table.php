<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTicketsThreadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_tickets_thread', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('admin_id')->nullable()->index('admin_id');
			$table->integer('user_id')->nullable()->index('user_id');
			$table->integer('ticket_id')->nullable()->index('ticket_id');
			$table->text('message')->nullable();
			$table->boolean('read_status')->nullable();
			$table->string('ip_address', 45)->nullable();
			$table->string('user_agent')->nullable();
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
		Schema::drop('tbl_tickets_thread');
	}

}
