<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToActUserIndetificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('act_user_indetification', function(Blueprint $table)
		{
			$table->foreign('fk_s_user', 'fk_act_user_indetification_s_user1')->references('ids_user')->on('s_user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('fk_act_external_user', 'fk_act_user_indetification_act_external_user1')->references('idact_external_user')->on('act_external_user')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('act_user_indetification', function(Blueprint $table)
		{
			$table->dropForeign('fk_act_user_indetification_s_user1');
			$table->dropForeign('fk_act_user_indetification_act_external_user1');
		});
	}

}
