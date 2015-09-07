<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Splace\Magazines;
use App\Splace\Article;

class WelcomeController extends Controller {

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
		//$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('frontend/splace')
			->with('navigation', $this->navigationList(Article::getArticleList(Session::get('active', Magazines::getActive())), Magazines::getAll()))
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('language', Session::get('language', 'de'));
	}

	private function navigationList($articles, $magazines) {
		$magazineList = "";
		foreach($magazines as $m) {
			$magazineList .= "{name: '#".$m->version." ".$m->title."', url: '/".$m->magazine_id."/splace'}, ";
		}

		$articleList = "{url: '/".Session::get('active')."/splace', title: 'Cover', subtitle: ''},
				{url: '/".Session::get('active')."/help', title: 'Hilfe', subtitle: ''},
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

		$list = "{ 
				issueList: [".$magazineList."], 
				navigationItems: [".$articleList."]
				}";

		return $list;
	}
}
