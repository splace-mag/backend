<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\User;

class UserController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
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
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = \Auth::user();

		return view('user')
			->with('user', $user);
	}

	public function saveUser() {
		$user = Input::get('user');

		\Log::info($user['id'].' + '.\Auth::user()->id);
		if($user['id'] != \Auth::user()->id) {
			return response()->json(['success' => 'false'], 404);
		}

		User::editUser($user);
		return response()->json(['success' => 'true'], 200);
	}

}
