<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Registrar;
use Request;
use App\Splace\Article;
use App\Splace\Section;
use App\Splace\Links;
use App\Splace\Booktips;
use App\Splace\UploadHandler;

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
		$article = Article::getAll(Session::get('active'));
		if(count($article) == '0') {
			$warning = 'noarticleexists';
		}
		else {
			$warning = '-';
		}

		return view('admin/articles')
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
		return view('admin/articleeditor')
			->with('new', true);
	}

	/**
	 * Show the article markdown editor with specified article
	 *
	 * @return Response
	 */
	public function editArticle($id)
	{
		if(!Article::exists($id)) {
			return view('admin/articles')
				->with('articles', Article::getAll(Session::get('active')))
				->with('warning', 'noarticlewiththisid');
		}

		return view('admin/articleeditor')
			->with('article', Article::getById($id))
			->with('links', Links::getByArticle($id))
			->with('booktips', Booktips::getByArticle($id))
			->with('new', false);
	}

	/**
	 * Save new or edited article
	 *
	 * @return Response
	 */
	public function saveArticle()
	{
		$article = Request::input('article');
		$id = $article['id'];
		
		if(Article::exists($article['id'])) {
			Article::editArticle($article);
		}
		else {
			$id = Article::createArticle($article);
		}
		Section::insertSections($id, Request::input('sectionsDE'), Request::input('sectionsEN'));

		Links::deleteLinksByArticle($id);
		$links = Request::input('links');
		if($links != 0) {
			foreach ($links as $link) {
				Links::createLink($link, $id);
			}
		}

		Booktips::deleteBooktipsByArticle($id);
		$booktips = Request::input('booktips', 0);
		if($booktips != 0) {
			foreach ($booktips as $booktip) {
				Booktips::createBooktip($booktip, $id);
			}
		}

		return response()->json(['success' => 'true', 'articleId' => $id]);
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

	public function sortArticles() 
	{
		$articles = Request::input('articles');

		if(count($articles) > 0) {
			foreach($articles as $article) {
				Article::sortArticle($article);
			}
		}
			
		
		return response()->json(['success' => 'true']);
	}

	public function fileUpload($id) 
	{

		if(Request::hasFile('cover_image')) {
			$file = Request::file('cover_image');
			$filename = time().$file->getClientOriginalName();
			$file->move(public_path('images'), $filename);
			
			Article::saveCoverImage($id, $filename, $file->getClientOriginalName());
		}

		if(Request::hasFile('bio_image')) {
			$file = Request::file('bio_image');
			$filename = time().$file->getClientOriginalName();
			$file->move(public_path('images'), $filename);
			
			Article::saveBioImage($id, $filename, $file->getClientOriginalName());
		}
		
		return response()->json(['success' => 'true']);
	}

}
