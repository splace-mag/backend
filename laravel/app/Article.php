<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Carbon\Carbon;

class Article extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';

	public $timestamps = false;

	public static function getAll() {
		return Article::paginate(10);
	}
	public static function getFirst($count) {
		return Article::orderBy('created_at', 'asc')->take($count)->get();
	}
	public static function getById($id) {
		return Article::where('article_id', $id)->first();
	}
	
	public static function exists($id) {
		if(Article::where('article_id', $id)->count() >= '1') {
			return true;
		}
		return false;
	}

	public static function createArticle($article) {
		Article::insert([
			'titleDE' => $article['titleDE'], 
			'page_titleDE' => $article['page_titleDE'], 
			'page_sub_titleDE' => $article['page_subtitleDE'], 
			'textDE' => $article['textDE'], 
			'editor_section_codeDE' => $article['editor_section_codeDE'], 
			'titleEN' => $article['titleEN'], 
			'page_titleEN' => $article['page_titleEN'], 
			'page_sub_titleEN' => $article['page_subtitleEN'], 
			'textEN' => $article['textEN'], 
			'editor_section_codeEN' => $article['editor_section_codeEN'], 
			'author_name' => $article['author'], 
			'author_descriptionDE' => $article['author_descriptionDE'], 
			'author_descriptionEN' => $article['author_descriptionEN'], 
			'used_material' => $article['used_material'], 
			'created_at' => new Carbon]);
	}

	public static function editArticle($article) {
		Article::where('article_id', $article['id'])
			->update([
				'titleDE' => $article['titleDE'], 
				'page_titleDE' => $article['page_titleDE'], 
				'page_sub_titleDE' => $article['page_subtitleDE'], 
				'textDE' => $article['textDE'], 
				'editor_section_codeDE' => $article['editor_section_codeDE'], 
				'titleEN' => $article['titleEN'], 
				'page_titleEN' => $article['page_titleEN'], 
				'page_sub_titleEN' => $article['page_subtitleEN'], 
				'textEN' => $article['textEN'], 
				'editor_section_codeEN' => $article['editor_section_codeEN'], 
				'author_name' => $article['author'], 
				'author_descriptionDE' => $article['author_descriptionDE'], 
				'author_descriptionEN' => $article['author_descriptionEN'], 
				'used_material' => $article['used_material'], 
				'updated_at' => new Carbon]);
	}

	public static function deleteArticle($id) {
		Article::where('article_id', $id)->delete();
	}

}
