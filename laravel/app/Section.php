<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Carbon\Carbon;

class Section extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sections';

	public $timestamps = false;

	public static function getAll() {
		return Section::orderBy('article_id', 'asc')->paginate(15);
	}
	public static function getByArticle($article_id) {
		return Section::where('article_id', $article_id)->paginate(15);
	}
	public static function getById($id) {
		return Section::where('section_id', $id)->first();
	}
	
	public static function exists($id) {
		if(Section::where('section_id', $id)->count() >= '1') {
			return true;
		}
		return false;
	}

	public static function insertSections($article_id, $sectionsDE, $sectionsEN) {
		Section::where('article_id', $article_id)->delete();

		foreach($sectionsDE as $section) {
			Section::insert([
				'article_id' => $article_id, 
				'key' => $section['id'], 
				'textDE' => $section['html'], 
				'created_at' => new Carbon]);
		}
		foreach ($sectionsEN as $section) {
			if(Section::where('article_id', $article_id)->where('key', $section['id'])->count() >= '1') {
				Section::where('article_id', $article_id)->where('key', $section['id'])
					->update(['textEN' => $section['html']]);
			}
			else {
				Section::insert([
				'article_id' => $article_id, 
				'key' => $section['id'], 
				'textEN' => $section['html'], 
				'created_at' => new Carbon]);
			}
		}
	}

	public static function editSection($section) {
		Section::where('section_id', $section['id'])
			->update([ 
				'note_shortDE' => $section['note_shortDE'], 
				'note_shortEN' => $section['note_shortEN'], 
				'noteDE' => $section['noteDE'], 
				'noteEN' => $section['noteEN'], 
				'updated_at' => new Carbon]);
	}

	public static function deleteSection($section_id) {
		Section::where('section_id', $section_id)->delete();
	}

	public static function deleteArticleSections($article_id) {
		Section::where('article_id', $article_id)->delete();
	}


}
