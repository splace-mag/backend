<?php namespace App\Http\Controllers;

use App\Article;
use App\Section;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Registrar;

class ArticleController extends Controller {

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
	{		$article = Article::getAll();
		if(count($article) == '0') {
			$warning = 'noarticleexists';
		}
		else {
			$warning = '-';
		}

		return view('articles')
			->with('articles', $article)
			->with('warning', $warning);
	}

	/**
	 * Show the article markdown editor with new article
	 *
	 * @return Response
	 */
	public function newArticle()
	{
		return view('articleeditor');
	}

	/**
	 * Show the article markdown editor with specified article
	 *
	 * @return Response
	 */
	public function editArticle($id)
	{
		if(!Article::exists($id)) {
			return view('articles')
				->with('articles', Article::getAll())
				->with('warning', 'noarticlewiththisid');
		}

		return view('articleeditor')
			->with('article', Article::getById($id));
	}

	/**
	 * Save new or edited article
	 *
	 * @return Response
	 */
	public function saveArticle()
	{
		$article = Input::get('article');
		
		if(Article::exists($article['id'])) {
			Article::editArticle($article);
		}
		else {
			Article::createArticle($article);
		}
		Section::insertSections($article['id'], Input::get('sectionsDE'), Input::get('sectionsEN'));

		return response()->json(['success' => 'true']);
	}

	/**
	 * Delete article by id
	 *
	 * @return Response
	 */
	public function deleteArticle($id)
	{
		Article::deleteArticle($id);

		return redirect('admin/article');
	}

}
