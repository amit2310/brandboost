<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblTeamRolePermissionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_team_role_permission', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('role_id');
			$table->integer('permission_id');
			$table->boolean('permission')->nullable()->comment('1= read, 2=write');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_team_role_permission');
	}

}
