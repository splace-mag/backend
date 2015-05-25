<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooktipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booktips', function($table) {
			$table->increments('booktip_id');
			$table->integer('article_id');
			$table->integer('number');
			$table->text('textDE');
			$table->text('textEN');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('booktips');
	}

}
