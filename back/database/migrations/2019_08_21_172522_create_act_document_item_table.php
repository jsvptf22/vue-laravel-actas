<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActDocumentItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('act_document_item', function(Blueprint $table)
		{
			$table->integer('idact_document_item', true);
			$table->string('name', 100);
			$table->text('description', 65535)->nullable();
			$table->integer('fk_act_document')->unsigned()->index('fk_act_document_item_act_document1_idx');
			$table->integer('state')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('act_document_item');
	}

}
