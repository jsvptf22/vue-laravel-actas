<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActDocumentTopicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('act_document_topic', function(Blueprint $table)
		{
			$table->integer('idact_document_topic', true);
			$table->text('name', 65535);
			$table->text('description', 65535)->nullable();
			$table->integer('fk_act_document');
			$table->integer('state')->nullable()->default(1);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('act_document_topic');
	}

}
