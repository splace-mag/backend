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
		return Article::where('magazine_id', $magazine_id)->orderBy('number', 'asc')->paginate(15);
	}
	public static function getFirst($count) {
		$magazine_id = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		return Article::where('magazine_id', $magazine_id)->orderBy('updated_at', 'desc')->take($count)->get();
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
		\Log::info($article);

		return Article::insertGetId([
			'magazine_id' => $magazine_id, 
			'titleDE' => $article['titleDE'], 
			'titleEN' => $article['titleEN'], 
			'spitzmarke' => $article['spitzmarke'], 
			'page_titleDE' => $article['page_titleDE'], 
			'page_titleEN' => $article['page_titleEN'], 
			'page_title_padding_left' => $article['page_title_padding_left'], 
			'page_title_padding_top' => $article['page_title_padding_top'], 
			'page_sub_titleDE' => $article['page_subtitleDE'], 
			'page_sub_titleEN' => $article['page_subtitleEN'], 
			'page_sub_title_padding_left' => $article['page_sub_title_padding_left'], 
			'page_sub_title_padding_top' => $article['page_sub_title_padding_top'], 
			'introductionDE' => $article['introductionDE'], 
			'introductionEN' => $article['introductionEN'], 
			'reading_time' => $article['reading_time'], 
			'gradient_1' => $article['gradient_1'], 
			'gradient_2' => $article['gradient_2'], 
			'link_color' => $article['link_color'], 
			'h2DE' => $article['h2DE'], 
			'h2EN' => $article['h2EN'], 
			'h3DE' => $article['h3DE'], 
			'h3EN' => $article['h3EN'], 
			'editor_section_codeDE' => $article['editor_section_codeDE'], 
			'editor_section_codeEN' => $article['editor_section_codeEN'], 
			'author_name' => $article['author_name'], 
			'bio_textDE' => $article['bio_textDE'], 
			'bio_textEN' => $article['bio_textEN'], 
			'used_materialDE' => $article['used_materialDE'], 
			'used_materialEN' => $article['used_materialEN'], 
			'cover_image_padding_left' => $article['cover_image_padding_left'], 
			'cover_image_padding_top' => $article['cover_image_padding_top'], 
			'created_at' => new Carbon, 
			'updated_at' => new Carbon]);
	}

	public static function editArticle($article) {
		Article::where('article_id', $article['id'])
			->update([
				'titleDE' => $article['titleDE'], 
				'titleEN' => $article['titleEN'], 
				'spitzmarke' => $article['spitzmarke'], 
				'page_titleDE' => $article['page_titleDE'], 
				'page_titleEN' => $article['page_titleEN'], 
				'page_title_padding_left' => $article['page_title_padding_left'], 
				'page_title_padding_top' => $article['page_title_padding_top'], 
				'page_sub_titleDE' => $article['page_subtitleDE'], 
				'page_sub_titleEN' => $article['page_subtitleEN'], 
				'page_sub_title_padding_left' => $article['page_sub_title_padding_left'], 
				'page_sub_title_padding_top' => $article['page_sub_title_padding_top'], 
				'introductionDE' => $article['introductionDE'], 
				'introductionEN' => $article['introductionEN'], 
				'reading_time' => $article['reading_time'], 
				'gradient_1' => $article['gradient_1'], 
				'gradient_2' => $article['gradient_2'], 
				'link_color' => $article['link_color'],
				'h2DE' => $article['h2DE'], 
				'h2EN' => $article['h2EN'], 
				'h3DE' => $article['h3DE'], 
				'h3EN' => $article['h3EN'], 
				'editor_section_codeDE' => $article['editor_section_codeDE'], 
				'editor_section_codeEN' => $article['editor_section_codeEN'], 
				'author_name' => $article['author_name'], 
				'bio_textDE' => $article['bio_textDE'], 
				'bio_textEN' => $article['bio_textEN'], 
				'used_materialDE' => $article['used_materialDE'], 
				'used_materialEN' => $article['used_materialEN'], 
				'cover_image_padding_left' => $article['cover_image_padding_left'], 
				'cover_image_padding_top' => $article['cover_image_padding_top'], 
				'updated_at' => new Carbon]);
	}

	public static function deleteArticle($id) {
		Article::where('article_id', $id)->delete();
	}

	public static function sortArticle($article) {
		Article::where('article_id', $article['id']) 
			->update([
				'number' => $article['number']]);
	}

	public static function saveCoverImage($article_id, $name, $originalname) {
		Article::where('article_id', $article_id)
			->update([
				'cover_image' => $name, 
				'cover_image_name' => $originalname]);
	}

	public static function saveBioImage($article_id, $name, $originalname) {
		Article::where('article_id', $article_id)
			->update([
				'bio_image' => $name, 
				'bio_image_name' => $originalname]);
	}

}
