<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sections', function($table)
		{
			$table->increments('section_id');
			$table->integer('magazine_id');
			$table->integer('article_id');
			$table->string('key');
			$table->integer('number');
			$table->text('textDE');
			$table->text('textEN');
			$table->text('noteDE');
			$table->text('noteEN');
			$table->string('media_type');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sections');
	}

}
