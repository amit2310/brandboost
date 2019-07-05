<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationsEmailsCampaignsTemplatesCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automations_emails_campaigns_templates_categories', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('category_name', 200)->nullable();
			$table->text('description', 65535)->nullable();
			$table->boolean('status')->default(1);
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
		Schema::drop('tbl_automations_emails_campaigns_templates_categories');
	}

}
