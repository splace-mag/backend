<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function($table)
		{
			$table->increments('comment_id');
			$table->integer('user_id')->references('id')->on('users');
			$table->integer('section_id')->references('section_id')->on('sections');
			$table->integer('article_id')->references('article_id')->on('articles');
			$table->string('text');
			$table->boolean('read');
			$table->boolean('marked');
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
		Schema::drop('comments');
	}

}
