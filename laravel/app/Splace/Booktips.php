<?php namespace App\Splace;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Carbon\Carbon;

class Booktips extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'booktips';

	public $timestamps = true;

	public static function getByArticle($article_id) {
		return Booktips::where('article_id', $article_id)->orderBy('number', 'asc')->get();
	}
	public static function getById($id) {
		return Booktips::where('booktip_id', $id)->first();
	}
	
	public static function exists($id) {
		if(Booktips::where('booktip_id', $id)->count() >= '1') {
			return true;
		}
		return false;
	}

	public static function createBooktip($booktip, $article_id) {
		return Booktips::insertGetId([
			'article_id' => $article_id, 
			'number' => $booktip['number'], 
			'textDE' => $booktip['booktipDE'], 
			'textEN' => $booktip['booktipEN']]);
	}

	public static function editBooktip($booktip) {
		Booktips::where('booktip_id', $booktip['id'])
			->update([
				'number' => $booktip->number, 
				'textDE' => $booktip->booktipDE, 
				'textEN' => $booktip->booktipEN]);
	}

	public static function deleteBooktipsByArticle($article_id) {
		Booktips::where('article_id', $article_id)->delete();
	}

	public static function deleteBooktip($id) {
		Booktips::where('booktip_id', $id)->delete();
	}

}
