<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Registrar;
use Request;
use App\Splace\Magazines;
use App\Splace\Article;

class MainController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Main Controller
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
	public function index($magazineid = -1)
	{		
		$this->setMagazine($magazineid);
		return view('frontend/splace')
			->with('navigation', $this->navigationList(Article::getArticleList(Session::get('active', Magazines::getActive())), Magazines::getAll()))
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('language', Session::get('language', 'de'));
	}

	public function showContents($magazineid)
	{		
		$this->setMagazine($magazineid);
		$article = Article::getArticleList(Session::get('active', Magazines::getActive()));
		return view('frontend/contents')
			->with('navigation', $this->navigationList($article, Magazines::getAll()))
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('article', $article)
			->with('language', Session::get('language', 'de'));
	}

	public function showEditorial($magazineid)
	{		
		$this->setMagazine($magazineid);
		return view('frontend/editorial')
			->with('navigation', $this->navigationList(Article::getArticleList(Session::get('active', Magazines::getActive())), Magazines::getAll()))
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('language', Session::get('language', 'de'));
	}

	public function showHelpPage()
	{		
		return view('frontend/help')
			->with('navigation', $this->navigationList(Article::getArticleList(Session::get('active', Magazines::getActive())), Magazines::getAll()))
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
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
