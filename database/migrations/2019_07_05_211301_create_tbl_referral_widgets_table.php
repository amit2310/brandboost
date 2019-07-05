<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblReferralWidgetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_referral_widgets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('hashcode')->nullable();
			$table->integer('user_id')->nullable();
			$table->integer('referral_id')->nullable();
			$table->string('widget_title')->nullable();
			$table->text('widget_desc', 65535)->nullable();
			$table->integer('status')->default(0);
			$table->integer('delete_status')->default(0);
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
		Schema::drop('tbl_referral_widgets');
	}

}
