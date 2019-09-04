<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActExternalUserTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('act_external_user', function (Blueprint $table) {
			$table->increments('idact_external_user');
			$table->string('login', 45)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('firstname', 100);
			$table->string('secondname', 100)->nullable();
			$table->string('firstlastname', 100);
			$table->string('secondlastname', 100)->nullable();
			$table->string('state', 45)->default('Activo');
			$table->timestamp('create_time')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('update_time')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('act_external_user');
	}
}
