<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sections', function($table)
		{
			$table->renameColumn('noteDE', 'markdown_noteDE');
			$table->renameColumn('noteEN', 'markdown_noteEN');
		});
		Schema::table('sections', function($table)
		{
			$table->string('noteEN')->after('textEN');
			$table->string('noteDE')->after('textEN');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
