<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Registrar;
use App\Splace\Magazines;

class MagazinesController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');

		if(!\Auth::guest()) {
			if(\Auth::user()->is_admin != '1') {
				return redirect('user')->send();
			}
		}
		
	}


	public function showMagazines() {
		$magazines = Magazines::getAll();
		return view('admin/magazines')
			->with('magazines', $magazines);
	}

	public function showMagazine($id) {
		$magazine = Magazines::getById($id);
		return view('admin/magazineeditor')
			->with('magazine', $magazine)
			->with('new', false);
	}

	public function createMagazine() {
		return view('admin/magazineeditor')
			->with('new', true);
	}

	public function saveMagazine($id) {
		$magazine = Request::input('magazine');

		if($magazine['id'] == '-1') {
			Magazines::createMagazine($magazine);
		}
		else {
			Magazines::saveMagazine($magazine);
		}

		return response()->json(['success' => 'true']);
	}
	public function deleteMagazine($id) {
		Magazines::deleteMagazine($id);
		return redirect('admin/magazines');
	}

	public function setMagazine() {
		$active = Request::input('active', 'active');
		Session::put('active', $active);

		return response()->json(['success' => 'true']);
	}
}
