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
			$table->integer('article_id')->references('article_id')->on('articles');
			$table->string('key');
			$table->string('textDE');
			$table->string('textEN');
			$table->string('note_shortDE');
			$table->string('note_shortEN');
			$table->string('noteDE');
			$table->string('noteEN');
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
