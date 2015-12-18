<?php namespace App\Splace;

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

	public static function getAll($magazine = 'active') {
		if($magazine == 'active') {
			$magazine = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		}
		return Section::join('articles', 'articles.article_id', '=', 'sections.article_id')
			->where('sections.magazine_id', $magazine)
			->select('sections.section_id', 'sections.article_id', 'articles.spitzmarke', 'articles.titleDE', 'sections.key', 'sections.textDE', 'sections.textEN', 'sections.noteDE', 'sections.noteEN', 'sections.media_type')
			->orderBy('article_id', 'asc')
			->paginate(15);
	}
	public static function getByArticle($article_id) {
		return Section::where('article_id', $article_id)
			->orderBy('number')
			->paginate(15);
	}
	public static function getAllByArticle($article_id) {
		return Section::where('article_id', $article_id)
			->orderBy('number')
			->get();
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

	public static function insertSections($article_id, $sectionsDE, $sectionsEN, $magazine = 'active') {
		if($magazine == 'active') {
			$magazine = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		}

		if($sectionsDE != null) {
			foreach($sectionsDE as $section) {
				if(Section::where('article_id', $article_id)->where('key', $section['id'])->count() >= '1') {
					Section::where('article_id', $article_id)->where('key', $section['id'])
						->update([
							'textDE' => str_replace(' href=', ' target="_blank" href=', $section['html']), 
							'updated_at' => Carbon::now()]);
				}
				else {
					Section::insert([
						'article_id' => $article_id, 
						'magazine_id' => $magazine, 
						'key' => $section['id'], 
						'textDE' => str_replace(' href=', ' target="_blank" href=', $section['html']), 
						'created_at' => Carbon::now(), 
						'updated_at' => Carbon::now()]);
				}
			}
		}
		if($sectionsEN != null) { 
			foreach ($sectionsEN as $section) {
				if(Section::where('article_id', $article_id)->where('key', $section['id'])->count() >= '1') {
					Section::where('article_id', $article_id)->where('key', $section['id'])
						->update([
							'textEN' => str_replace(' href=', ' target="_blank" href=', $section['html']), 
							'updated_at' => Carbon::now()]);
				}
				else {
					Section::insert([
						'article_id' => $article_id, 
						'magazine_id' => $magazine, 
						'key' => $section['id'], 
						'textEN' => str_replace(' href=', ' target="_blank" href=', $section['html']), 
						'created_at' => Carbon::now(), 
						'updated_at' => Carbon::now()]);
				}
			}
		}
		Section::where('article_id', $article_id)->where('updated_at', '<', Carbon::now()->subSecond())->delete();
	}

	public static function editSection($section) {
		Section::where('section_id', $section['id'])
			->update([ 
				'noteDE' => $section['noteDE'], 
				'noteEN' => $section['noteEN'], 
				'markdown_noteDE' => $section['markdown_noteDE'], 
				'markdown_noteEN' => $section['markdown_noteEN'], 
				'media_type' => 'multiple',
				'updated_at' => Carbon::now()]);
	}

	public static function deleteSection($section_id) {
		Section::where('section_id', $section_id)->delete();
	}

	public static function deleteArticleSections($article_id) {
		Section::where('article_id', $article_id)->delete();
	}

	public static function sortSection($section) {
		Section::where('section_id', $section['id']) 
			->update([
				'number' => $section['number']]);
	}

	public static function getMedia($section_id) {
		$media = \DB::table('media')
			->where('section_id', $section_id)
			->get();

		$section = array(
			'image' => false, 
			'youtube-video' => false, 
			'youtube-cover' => false, 
			'vimeo-video' => false, 
			'vimeo-cover' => false, 
			'cover' => false, 
			'gallery' => false);

		$i = 0;
		foreach ($media as $m) {
			if($m->media_type == 'image') {
				$section['image'] = true;
				$section['image-data'] = $m;
			}
			else if($m->media_type == 'youtube-video') {
				$section['youtube-video'] = true;
				$section['youtube-video-data'] = $m;
			}
			else if($m->media_type == 'youtube-cover') {
				$section['youtube-cover'] = true;
				$section['youtube-cover-data'] = $m;
			}
			else if($m->media_type == 'vimeo-video') {
				$section['vimeo-video'] = true;
				$section['vimeo-video-data'] = $m;
			}
			else if($m->media_type == 'vimeo-cover') {
				$section['vimeo-cover'] = true;
				$section['vimeo-cover-data'] = $m;
			}
			else if($m->media_type == 'cover') {
				$section['cover'] = true;
				$section['cover-data'] = $m;
			}
			else if($m->media_type == 'gallery') {
				$section['gallery'] = true;
				$section['gallery-data'][] = $m;
			}
		}

		return $section;
	}

	public static function saveMedia($section_id, $file_name, $original_name, $media_type, $descriptionDE, $descriptionEN, $number = 0) {
		if($media_type == 'image' || $media_type == 'cover') {
			$media = \DB::table('media')
				->where('section_id', $section_id)
				->where('media_type', $media_type)
				->get();

			foreach($media as $m) {
				if(\File::exists('images/'.$m->file_name)) {
					\File::delete('images/'.$m->file_name);
				}
			}
			\DB::table('media')
				->where('section_id', $section_id)
				->where('media_type', $media_type)
				->delete();
		}
		
		if($media_type == 'youtube-video' || $media_type == 'vimeo-video') {
			if(\DB::table('media')->where('section_id', $section_id)->where('media_type', $media_type)->count() >= '1') {
				if($original_name == '-') {
					\DB::table('media')
						->where('section_id', $section_id)
						->where('media_type', $media_type)
						->delete();
				}
				else {
					\DB::table('media')
						->where('section_id', $section_id)
						->where('media_type', $media_type)
						->update([
							'original_name' => $original_name, 
							'descriptionDE' => $descriptionDE, 
							'descriptionEN' => $descriptionEN
						]);
				}
			}
			else if($original_name != '-') {
				\DB::table('media')
					->insert([
						'section_id' => $section_id, 
						'media_type' => $media_type, 
						'original_name' => $original_name, 
						'descriptionDE' => $descriptionDE, 
						'descriptionEN' => $descriptionEN
					]);
			}
		}
		else {	
			\DB::table('media')
				->insert([
					'section_id' => $section_id, 
					'file_name' => $file_name, 
					'original_name' => $original_name, 
					'media_type' => $media_type, 
					'number' => $number, 
					'descriptionDE' => $descriptionDE, 
					'descriptionEN' => $descriptionEN
				]);
		}
	}

	public static function saveMediaDescription($media) {
		if($media == '') {
			return;
		}
		foreach($media as $m) {
			\DB::table('media')
				->where('media_id', $m['id'])
				->update([
					'descriptionDE' => $m['descriptionDE'], 
					'descriptionEN' => $m['descriptionEN']
				]);
		}
	}

	public static function deleteMedia($filename) {
		\DB::table('media')
			->where('file_name', $filename)
			->delete();
	}

	
}
