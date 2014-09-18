<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessiondbTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ses_db', function(Blueprint $table){
			$table->increments('id');
			$table->integer('refid')->references('id')->on('users');
			$table->timestamp('lastseen');
			$table->boolean('status');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ses_db');
	}

}
