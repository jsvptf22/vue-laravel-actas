<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActDocumentUserTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('act_document_user', function (Blueprint $table) {
			$table->integer('idact_document_user', true);
			$table->integer('relation_type');
			$table->integer('state')->nullable()->default(1);
			$table->string('user_identification', 45);
			$table->integer('external');
			$table->integer('fk_act_document');
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
		Schema::drop('act_document_user');
	}
}
