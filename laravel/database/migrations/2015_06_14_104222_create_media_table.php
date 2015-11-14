<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media', function($table) {
			$table->increments('media_id');
			$table->integer('section_id');
			$table->string('media_type');
			$table->integer('number');
			$table->string('file_name');
			$table->string('original_name');
			$table->text('descriptionDE');
			$table->text('descriptionEN');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('media');
	}

}
