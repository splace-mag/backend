<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Registrar;
use Request;
use App\Splace\Article;
use App\Splace\Section;
use App\Splace\Links;
use App\Splace\Booktips;
use App\Splace\Comments;
use App\Splace\Magazines;

class ArticleController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Article Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{		
		return view('frontend/splace');
	}


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function showArticle($magazineid, $number)
	{		
		$this->setMagazine($magazineid);

		$article = Article::getByNumber($magazineid, $number);
		if($article == '') {
			$article = Article::getByNumber(Magazines::getActive(), 1);
		}

		$navigationList = $this->navigationList(Article::getArticleList(Magazines::getActive()), Magazines::getAll());

		$sections = Section::getByArticle($article->article_id);
		foreach($sections as $s) {
			$s->comments = Comments::getBySectionForArticle($s->section_id);
		}

		return view('frontend/article')
			->with('article', $article)
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('navigation', $navigationList) 
			->with('sections', $sections)
			->with('links', Links::getByArticle($article->article_id))
			->with('booktips', Booktips::getByArticle($article->article_id))
			->with('language', Session::get('language', 'de'));
	}

	private function setMagazine($magazineid) {
		if(Session::get('active', '0') != $magazineid && Magazines::getById($magazineid) != '') {
			Session::put('active', $magazineid);
		} 
		else if(Session::get('active', '0') == '') {
			Session::put('active', Magazines::getActive());
		}
	}

	private function navigationList($articles, $magazines) {
		$magazineList = "";
		foreach($magazines as $m) {
			$magazineList .= "{name: '#".$m->version." ".$m->title."', url: '/".$m->magazine_id."/splace'}, ";
		}

		$articleList = "{url: '/".Session::get('active')."/splace', title: 'Cover', subtitle: ''},
				{url: '/help', title: 'Hilfe', subtitle: ''},
				{url: '/".Session::get('active')."/content', title: 'Inhaltsverzeichnis', subtitle: 'Index'},
				{url: '/".Session::get('active')."/editorial', title: 'Editorial', subtitle: 'Editorial'},";

		foreach ($articles as $a) {
			if(Session::get('language', 'de') == 'de') {
				$articleList .= "\n {url: '/".$a->magazine_id."/article/".$a->number."', title: '".$a->titleDE."', subtitle: '".$a->page_sub_titleDE."'},";
			}
			else {
				$articleList .= "\n {url: '/".$a->magazine_id."/article/".$a->number."', title: '".$a->titleEN."', subtitle: '".$a->page_sub_titleEN."'},";
			}
		}

		$user = \Auth::user();
		$userData = '';
		if($user) {
			$userData = "user: {id: ".$user->id.", name: '".$user->name."', email: '".$user->email."', image: '".$user->picture."'}";
		}

		$list = "{ 
				issueList: [".$magazineList."], 
				navigationItems: [".$articleList."], 
				token: '".Session::token()."', 
				".$userData."
				}";

		return $list;
	}
}
