<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Registrar;
use App\Splace\Article;
use App\Splace\Comments;
use App\Splace\Magazines;
use App\User;
use Request;

class AdminController extends Controller {

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

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Session::get('active', 'error') == 'error') {
			Session::put('active', Magazines::getActive());
		} 
		$article = Article::getFirst(5, Session::get('active'));
		if(count($article) == '0') {
			$warning['article'] = 'noarticleexists';
		}
		else {
			$warning['article'] = '-';
		}

		$comments = Comments::getUnread();

		if(count($comments) == '0') {
			$warning['comments'] = 'nonewcomment';
		}
		else {
			$warning['comments'] = '-';
		}

		$warning['user'] = '-';

		return view('admin/admin')
			->with('articles', $article)
			->with('comments', $comments)
			->with('warning', $warning)
			->with('magazines', Magazines::getAll())
			->with('active', Session::get('active', Magazines::getActive()));
	}

	public function showUser() {
		$user = User::paginate(20);

		return view('admin/user')
			->with('user', $user);
	}
	public function deleteUser($id) {
		if($id != \Auth::user()->id) {
			User::find($id)->delete();
		}

		return redirect('admin/user')->send();
	}

}
