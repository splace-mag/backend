<?php namespace App\Splace;

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

	public $timestamps = true;

	public static function getAll() {
		$magazine_id = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		return Article::where('magazine_id', $magazine_id)->orderBy('created_at', 'desc')->paginate(10);
	}
	public static function getFirst($count) {
		$magazine_id = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		return Article::where('magazine_id', $magazine_id)->orderBy('created_at', 'desc')->take($count)->get();
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
		$magazine_id = \DB::table('magazines')->where('active', '1')->first()->magazine_id;

		return Article::insertGetId([
			'magazine_id' => $magazine_id, 
			'titleDE' => $article['titleDE'], 
			'titleEN' => $article['titleEN'], 
			'spitzmarke' => $article['spitzmarke'], 
			'page_titleDE' => $article['page_titleDE'], 
			'page_titleEN' => $article['page_titleEN'], 
			'page_sub_titleDE' => $article['page_subtitleDE'], 
			'page_sub_titleEN' => $article['page_subtitleEN'], 
			'introductionDE' => $article['introductionDE'], 
			'introductionEN' => $article['introductionEN'], 
			'reading_time' => $article['reading_time'], 
			'cover_image' => $article['cover_image_url'], 
			'gradient_1' => $article['gradient_1'], 
			'gradient_2' => $article['gradient_2'], 
			'h2DE' => $article['h2DE'], 
			'h2EN' => $article['h2EN'], 
			'h3DE' => $article['h3DE'], 
			'h3EN' => $article['h3EN'], 
			'editor_section_codeDE' => $article['editor_section_codeDE'], 
			'editor_section_codeEN' => $article['editor_section_codeEN'], 
			'author_name' => $article['author_name'], 
			'bio_textDE' => $article['bio_textDE'], 
			'bio_textEN' => $article['bio_textEN'], 
			'bio_image' => $article['bio_image_url'], 
			'used_materialDE' => $article['used_materialDE'], 
			'used_materialEN' => $article['used_materialEN'], 
			'created_at' => new Carbon]);
	}

	public static function editArticle($article) {
		Article::where('article_id', $article['id'])
			->update([
				'titleDE' => $article['titleDE'], 
				'titleEN' => $article['titleEN'], 
				'spitzmarke' => $article['spitzmarke'], 
				'page_titleDE' => $article['page_titleDE'], 
				'page_titleEN' => $article['page_titleEN'], 
				'page_sub_titleDE' => $article['page_subtitleDE'], 
				'page_sub_titleEN' => $article['page_subtitleEN'], 
				'introductionDE' => $article['introductionDE'], 
				'introductionEN' => $article['introductionEN'], 
				'reading_time' => $article['reading_time'], 
				'cover_image' => $article['cover_image_url'], 
				'gradient_1' => $article['gradient_1'], 
				'gradient_2' => $article['gradient_2'], 
				'h2DE' => $article['h2DE'], 
				'h2EN' => $article['h2EN'], 
				'h3DE' => $article['h3DE'], 
				'h3EN' => $article['h3EN'], 
				'editor_section_codeDE' => $article['editor_section_codeDE'], 
				'editor_section_codeEN' => $article['editor_section_codeEN'], 
				'author_name' => $article['author_name'], 
				'bio_textDE' => $article['bio_textDE'], 
				'bio_textEN' => $article['bio_textEN'], 
				'bio_image' => $article['bio_image_url'], 
				'used_materialDE' => $article['used_materialDE'], 
				'used_materialEN' => $article['used_materialEN'], 
				'updated_at' => new Carbon]);
	}

	public static function deleteArticle($id) {
		Article::where('article_id', $id)->delete();
	}

}
