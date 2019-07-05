<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_tickets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('admin_id')->nullable()->index('admin_id');
			$table->integer('user_id')->nullable()->index('user_id');
			$table->string('department', 45)->nullable();
			$table->string('subject')->nullable();
			$table->text('message')->nullable();
			$table->boolean('status')->nullable();
			$table->boolean('response')->nullable();
			$table->boolean('reply')->nullable();
			$table->string('ip_address', 45)->nullable();
			$table->string('useragent')->nullable();
			$table->boolean('ticket_response_status')->nullable();
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
		Schema::drop('tbl_tickets');
	}

}
