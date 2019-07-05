<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAutomationsEmailsCampaignsTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_automations_emails_campaigns_templates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->index('user_id');
			$table->integer('category_id')->nullable();
			$table->string('template_name');
			$table->text('template_subject', 65535);
			$table->text('introduction', 65535)->nullable();
			$table->text('greeting', 65535)->nullable();
			$table->text('template_content');
			$table->text('stripo_html')->nullable();
			$table->text('stripo_css')->nullable();
			$table->text('stripo_compiled_html')->nullable();
			$table->boolean('status')->default(1);
			$table->string('template_type', 200);
			$table->integer('write_permission')->default(1);
			$table->string('preview_icon')->nullable();
			$table->string('created', 50);
			$table->string('updated', 50);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_automations_emails_campaigns_templates');
	}

}
