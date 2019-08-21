<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActUserIndetificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('act_user_indetification', function(Blueprint $table)
		{
			$table->increments('idact_user_indetification');
			$table->integer('fk_s_user')->unsigned()->index('fk_act_user_indetification_s_user1_idx');
			$table->integer('fk_act_external_user')->unsigned()->index('fk_act_user_indetification_act_external_user1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('act_user_indetification');
	}

}
