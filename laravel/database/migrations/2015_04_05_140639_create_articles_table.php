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
			$table->integer('magazine_id');
			$table->integer('number')->default(1);
			$table->string('spitzmarke');
			$table->string('titleDE');
			$table->string('titleEN');
			$table->text('page_titleDE');
			$table->text('page_titleEN');
			$table->integer('page_title_padding_left');
			$table->integer('page_title_padding_top');
			$table->text('page_sub_titleDE');
			$table->text('page_sub_titleEN');
			$table->integer('page_sub_title_padding_left');
			$table->integer('page_sub_title_padding_top');
			$table->string('app_name');
			$table->string('reading_time');
			$table->string('cover_image');
			$table->string('cover_image_name');
			$table->integer('cover_image_padding_left');
			$table->integer('cover_image_padding_top');
			$table->string('gradient_1');
			$table->string('gradient_2');
			$table->string('link_color');
			$table->string('subtitle_backgroundcolor');
			$table->text('introductionDE');
			$table->text('introductionEN');
			$table->text('markdown_introductionDE');
			$table->text('markdown_introductionEN');
			$table->text('summaryDE');
			$table->text('summaryEN');
			$table->text('markdown_summaryDE');
			$table->text('markdown_summaryEN');
			$table->string('author_name');
			$table->string('bio_image');
			$table->string('bio_image_name');
			$table->text('bio_textDE');
			$table->text('bio_textEN');
			$table->text('markdown_bio_textDE');
			$table->text('markdown_bio_textEN');
			$table->text('bio_text_shortDE');
			$table->text('bio_text_shortEN');
			$table->text('used_materialDE');
			$table->text('used_materialEN');
			$table->text('markdown_used_materialDE');
			$table->text('markdown_used_materialEN');
			$table->text('editor_section_codeDE');
			$table->text('editor_section_codeEN');
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
