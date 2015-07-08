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

	public static function insertSections($article_id, $sectionsDE, $sectionsEN, $magazine = 'active') {
		if($magazine == 'active') {
			$magazine = \DB::table('magazines')->where('active', '1')->first()->magazine_id;
		}

		if($sectionsDE != null) {
			foreach($sectionsDE as $section) {
				if(Section::where('article_id', $article_id)->where('key', $section['id'])->count() >= '1') {
					Section::where('article_id', $article_id)->where('key', $section['id'])
						->update([
							'textDE' => $section['html'], 
							'updated_at' => Carbon::now()]);
				}
				else {
					\Log::info($section['id'].': insert');
					Section::insert([
						'article_id' => $article_id, 
						'magazine_id' => $magazine, 
						'key' => $section['id'], 
						'textDE' => $section['html'], 
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
							'textEN' => $section['html'], 
							'updated_at' => Carbon::now()]);
				}
				else {
					Section::insert([
						'article_id' => $article_id, 
						'magazine_id' => $magazine, 
						'key' => $section['id'], 
						'textEN' => $section['html'], 
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
				'media_type' => $section['media_type'],
				'updated_at' => new Carbon]);
	}

	public static function deleteSection($section_id) {
		Section::where('section_id', $section_id)->delete();
	}

	public static function deleteArticleSections($article_id) {
		Section::where('article_id', $article_id)->delete();
	}

	public static function getMedia($section_id) {
		$media = \DB::table('media')
			->where('section_id', $section_id)
			->get();

		$section['type'] = 'empty';

		foreach ($media as $m) {
			if($m->media_type == 'image') {
				$section['type'] = 'image';
				$section['image'] = $m;
			}
			else if($m->media_type == 'video') {
				$section['type'] = 'video';
				$section['video'] = $m;
			}
			else if($m->media_type == 'cover') {
				$section['type'] = 'cover';
				$section['cover'] = $m;
			}
			else if($m->media_type == 'gallery') {
				$section['type'] = 'gallery';
				$section['gallery'][] = $m;
			}
		}

		return $section;
	}

	public static function saveMedia($section_id, $file_name, $original_name, $media_type, $number = 0) {
		if($media_type == 'image' || $media_type == 'video' || $media_type == 'cover') {
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

		\DB::table('media')
			->insert([
				'section_id' => $section_id, 
				'file_name' => $file_name, 
				'original_name' => $original_name, 
				'media_type' => $media_type, 
				'number' => $number]);
	}

	public static function saveMediaDescription($media) {
		if($media == '') {
			return;
		}
		foreach($media as $m) {
			\DB::table('media')
				->where('media_id', $m['id'])
				->update([
					'description' => $m['description']]);
		}
	}

	public static function deleteMedia($filename) {
		\DB::table('media')
			->where('file_name', $filename)
			->delete();
	}

	
}
