<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function($table)
		{
			$table->increments('article_id');
			$table->string('titleDE');
			$table->string('titleEN');
			$table->string('page_titleDE');
			$table->string('page_titleEN');
			$table->string('page_sub_titleDE');
			$table->string('page_sub_titleEN');
			$table->string('textDE');
			$table->string('textEN');
			$table->string('author_name');
			$table->string('author_image');
			$table->string('author_descriptionDE');
			$table->string('author_descriptionEN');
			$table->string('used_material');
			$table->string('editor_section_codeDE');
			$table->string('editor_section_codeEN');
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
		Schema::drop('articles');
	}

}
