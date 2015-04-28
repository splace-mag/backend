<?php namespace App\Http\Controllers;

use App\Article;
use App\Comments;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Registrar;

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
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$article = Article::getFirst(5);
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

		return view('admin')
			->with('articles', $article)
			->with('comments', $comments)
			->with('warning', $warning);
	}


}
