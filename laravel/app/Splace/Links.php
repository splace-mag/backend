<?php namespace App\Splace;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Carbon\Carbon;

class Links extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'links';

	public $timestamps = true;

	public static function getByArticle($article_id) {
		return Links::where('article_id', $article_id)->orderBy('number', 'asc')->get();
	}
	public static function getById($id) {
		return Links::where('link_id', $id)->first();
	}
	
	public static function exists($id) {
		if(Links::where('link_id', $id)->count() >= '1') {
			return true;
		}
		return false;
	}

	public static function createLink($link, $article_id) {
		if(strpos($link['link'], 'http') !== 0) {
			$link['link'] = 'http://'.$link['link'];
		}

		return Links::insertGetId([
			'article_id' => $article_id, 
			'number' => $link['number'], 
			'link' => $link['link'], 
			'link_descriptionDE' => $link['link_descriptionDE'], 
			'link_descriptionEN' => $link['link_descriptionEN']]);
	}

	public static function editLink($link) {
		if(strpos($link['link'], 'http') !== 0) {
			$link['link'] = 'http://'.$link['link'];
		}

		Links::where('link_id', $link['id'])
			->update([
				'number' => $link['number'], 
				'link' => $link['link'], 
				'link_descriptionDE' => $link['link_descriptionDE'], 
				'link_descriptionEN' => $link['link_descriptionEN']]);
	}

	public static function deleteLinksByArticle($article_id) {
		Links::where('article_id', $article_id)->delete();
	}

	public static function deleteLink($id) {
		Links::where('link_id', $id)->delete();
	}

}
