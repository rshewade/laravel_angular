<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('userid');
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('passhistory')->default('');
			$table->date('exp_date')->default('2099-01-01');
			$table->string('role');
			$table->date('verified_on')->default('2001-01-01');
			$table->boolean('status')->default(1);
			$table->integer('attempts')->default(0);
			$table->string('created_by')->default('system');
			$table->timestamps();
			$table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
