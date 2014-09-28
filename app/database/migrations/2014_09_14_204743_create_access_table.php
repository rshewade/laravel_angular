<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('access_db', function($t)
		{
			$t->increments('id');
			$t->string('role');
			$t->string('eroute');
			$t->string('iroutes');
			$t->string('name');
			$t->integer('parentid');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('access_db');
	}

}
