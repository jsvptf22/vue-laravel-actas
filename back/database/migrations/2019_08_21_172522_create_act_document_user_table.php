<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActDocumentUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('act_document_user', function(Blueprint $table)
		{
			$table->integer('idact_document_user', true);
			$table->timestamp('create_time')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('update_time')->nullable();
			$table->integer('relation_type')->unsigned();
			$table->integer('state')->default(1);
			$table->integer('fk_act_user_indetification')->unsigned()->index('fk_act_document_user_act_user_indetification1_idx');
			$table->integer('fk_act_document')->unsigned()->index('fk_act_document_user_act_document1_idx');
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
