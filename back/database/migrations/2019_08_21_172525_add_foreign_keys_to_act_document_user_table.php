<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActDocumentUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('act_document_user', function(Blueprint $table)
		{
			$table->foreign('fk_act_user_indetification', 'fk_act_document_user_act_user_indetification1')->references('idact_user_indetification')->on('act_user_indetification')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_act_document', 'fk_act_document_user_act_document1')->references('idact_document')->on('act_document')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('act_document_user', function(Blueprint $table)
		{
			$table->dropForeign('fk_act_document_user_act_user_indetification1');
			$table->dropForeign('fk_act_document_user_act_document1');
		});
	}

}