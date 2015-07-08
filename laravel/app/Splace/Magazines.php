<?php namespace App\Splace;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Magazines extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'magazines';

	public $timestamps = false;

	public static function getAll() {
		return Magazines::get();
	}

	public static function getById($id) {
		return Magazines::where('magazine_id', $id)->first();
	}

	public static function getActive() {
		return Magazines::where('active', '1')->first()->magazine_id;
	}

	public static function createMagazine($magazine) {
		if($magazine['active'] == '1') {
			Magazines::where('active', '1')->update(['active' => '0']);
		}

		$id = Magazines::insertGetId([
			'active' => $magazine['active'], 
			'title' => $magazine['title'], 
			'version' => $magazine['version']]);

		if(Magazines::where('active', '1')->count() == 0) {
			Magazines::where('magazine_id', $id)
			->update(['active' => '1']);
		}
	}

	public static function saveMagazine($magazine) {
		if($magazine['active'] == '1') {
			Magazines::where('active', '1')->update(['active' => '0']);
		}

		Magazines::where('magazine_id', $magazine['id'])
			->update([
				'active' => $magazine['active'], 
				'title' => $magazine['title'], 
				'version' => $magazine['version']]);

		if(Magazines::where('active', '1')->count() == 0) {
			Magazines::where('magazine_id', $magazine['id'])
			->update(['active' => '1']);
		}
	}

	public static function deleteMagazine($id) {
		Magazines::where('magazine_id', $id)->delete();

		if(Magazines::where('active', '1')->count() == 0) {
			$id = Magazines::orderBy('magazine_id', 'desc')->first()->magazine_id;
			Magazines::where('magazine_id', $id)
				->update(['active' => '1']);
		}
	}
}
