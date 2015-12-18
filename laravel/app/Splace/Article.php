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

	public static function getAll($magazine = 'active') {
		if($magazine == 'active') {
			$magazine = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		}
		return Article::where('magazine_id', $magazine)
			->orderBy('number', 'asc')
			->paginate(15);
	}
	public static function getArticleList($magazine = 'active') {
		if($magazine == 'active') {
			$magazine = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		}
		return Article::where('magazine_id', $magazine)
			->orderBy('number', 'asc')
			->select('magazine_id', 'article_id', 'number', 'titleDE', 'titleEN', 'page_titleDE', 'page_titleEN', 'page_sub_titleDE', 'page_sub_titleEN', 'summaryDE', 'summaryEN', 'spitzmarke')
			->get();
	}
	public static function getFirst($count, $magazine = 'active') {
		if($magazine == 'active') {
			$magazine = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		}
		return Article::where('magazine_id', $magazine)
			->orderBy('updated_at', 'desc')
			->take($count)
			->get();
	}
	public static function getById($id) {
		return Article::where('article_id', $id)->first();
	}

	public static function getByNumber($magazineid, $number) {
		return Article::where('magazine_id', $magazineid)
			->where('number', $number)
			->first();
	}
/*
	public static function getFullArticle($id) {
		$article = Article::where('articles.article_id', $id)
			->join('sections', 'sections.article_id', '=', 'articles.article_id')
			->join('links', 'links.article_id', '=', 'articles.article_id')
			->join('booktips', 'booktips.article_id', '=', 'articles.article_id')
			->first();
			return $article;
	}
*/
	public static function exists($id) {
		if(Article::where('article_id', $id)->count() >= '1') {
			return true;
		}
		return false;
	}

	public static function createArticle($article, $magazine = 'active') {
		if($magazine == 'active') {
			$magazine = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		}
		$number = Article::where('magazine_id', $magazine)->orderBy('number', 'desc')->first()->number;

		return Article::insertGetId([
			'magazine_id' => $magazine, 
			'titleDE' => $article['titleDE'], 
			'titleEN' => $article['titleEN'], 
			'number' => ($number+1), 
			'spitzmarke' => $article['spitzmarke'], 
			'page_titleDE' => $article['page_titleDE'], 
			'page_titleEN' => $article['page_titleEN'], 
			'page_title_padding_left' => $article['page_title_padding_left'], 
			'page_title_padding_top' => $article['page_title_padding_top'], 
			'page_sub_titleDE' => $article['page_subtitleDE'], 
			'page_sub_titleEN' => $article['page_subtitleEN'], 
			'page_sub_title_padding_left' => $article['page_sub_title_padding_left'], 
			'page_sub_title_padding_top' => $article['page_sub_title_padding_top'], 
			'app_name' => $article['app_name'], 
			'introductionDE' => $article['introductionDE'], 
			'introductionEN' => $article['introductionEN'], 
			'markdown_introductionDE' => $article['markdown_introductionDE'], 
			'markdown_introductionEN' => $article['markdown_introductionEN'], 
			'reading_time' => $article['reading_time'], 
			'gradient_1' => $article['gradient_1'], 
			'gradient_2' => $article['gradient_2'], 
			'link_color' => $article['link_color'], 
			'subtitle_backgroundcolor' => $article['subtitle_backgroundcolor'], 
			'summaryDE' => $article['summaryDE'], 
			'summaryEN' => $article['summaryEN'], 
			'markdown_summaryDE' => $article['markdown_summaryDE'], 
			'markdown_summaryEN' => $article['markdown_summaryEN'], 
			'editor_section_codeDE' => $article['editor_section_codeDE'], 
			'editor_section_codeEN' => $article['editor_section_codeEN'], 
			'author_name' => $article['author_name'], 
			'bio_textDE' => $article['bio_textDE'], 
			'bio_textEN' => $article['bio_textEN'], 
			'markdown_bio_textDE' => $article['markdown_bio_textDE'], 
			'markdown_bio_textEN' => $article['markdown_bio_textEN'], 
			'bio_text_shortDE' => $article['bio_text_shortDE'], 
			'bio_text_shortEN' => $article['bio_text_shortEN'], 
			'used_materialDE' => $article['used_materialDE'], 
			'used_materialEN' => $article['used_materialEN'], 
			'markdown_used_materialDE' => $article['markdown_used_materialDE'], 
			'markdown_used_materialEN' => $article['markdown_used_materialEN'], 
			'cover_image_padding_left' => $article['cover_image_padding_left'], 
			'cover_image_padding_top' => $article['cover_image_padding_top'], 
			'created_at' => Carbon::now(), 
			'updated_at' => Carbon::now()]);
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
				'app_name' => $article['app_name'], 
				'introductionDE' => $article['introductionDE'], 
				'introductionEN' => $article['introductionEN'], 
				'markdown_introductionDE' => $article['markdown_introductionDE'], 
				'markdown_introductionEN' => $article['markdown_introductionEN'], 
				'reading_time' => $article['reading_time'], 
				'gradient_1' => $article['gradient_1'], 
				'gradient_2' => $article['gradient_2'], 
				'link_color' => $article['link_color'],
				'subtitle_backgroundcolor' => $article['subtitle_backgroundcolor'], 
				'summaryDE' => $article['summaryDE'], 
				'summaryEN' => $article['summaryEN'], 
				'markdown_summaryDE' => $article['markdown_summaryDE'], 
				'markdown_summaryEN' => $article['markdown_summaryEN'], 
				'editor_section_codeDE' => $article['editor_section_codeDE'], 
				'editor_section_codeEN' => $article['editor_section_codeEN'], 
				'author_name' => $article['author_name'], 
				'bio_textDE' => $article['bio_textDE'], 
				'bio_textEN' => $article['bio_textEN'], 
				'markdown_bio_textDE' => $article['markdown_bio_textDE'], 
				'markdown_bio_textEN' => $article['markdown_bio_textEN'], 
				'bio_text_shortDE' => $article['bio_text_shortDE'], 
				'bio_text_shortEN' => $article['bio_text_shortEN'], 
				'used_materialDE' => $article['used_materialDE'], 
				'used_materialEN' => $article['used_materialEN'], 
				'markdown_used_materialDE' => $article['markdown_used_materialDE'], 
				'markdown_used_materialEN' => $article['markdown_used_materialEN'], 
				'cover_image_padding_left' => $article['cover_image_padding_left'], 
				'cover_image_padding_top' => $article['cover_image_padding_top'], 
				'updated_at' => Carbon::now()]);
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

	public static function saveBioImageBig($article_id, $name, $originalname) {
		Article::where('article_id', $article_id)
			->update([
				'bio_image_big' => $name, 
				'bio_image_big_name' => $originalname]);
	}

}
