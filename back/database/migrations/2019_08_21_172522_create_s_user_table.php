<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSUserTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('s_user', function (Blueprint $table) {
			$table->increments('ids_user');
			$table->string('login', 45)->unique('login_UNIQUE');
			$table->string('email', 100)->nullable();
			$table->string('password', 100);
			$table->string('firstname', 100);
			$table->string('secondname', 100)->nullable();
			$table->string('firstlastname', 100);
			$table->string('secondlastname', 100)->nullable();
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
		Schema::drop('s_user');
	}
}