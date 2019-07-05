<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblListsContactsBackupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_lists_contacts_backup', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('list_id')->nullable()->index('list_id');
			$table->string('firstname', 45)->nullable();
			$table->string('lastname', 45)->nullable();
			$table->string('type', 45)->nullable();
			$table->string('email', 45)->nullable();
			$table->string('phone', 45)->nullable();
			$table->boolean('email_verified')->nullable();
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
		Schema::drop('tbl_lists_contacts_backup');
	}

}
