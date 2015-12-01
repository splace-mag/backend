<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Registrar;
use Request;
use App\Splace\Magazines;
use App\Splace\Article;

class MainController extends Controller 
{

	protected function setMagazine($magazineid) {
		if(Session::get('active', '0') != $magazineid && Magazines::getById($magazineid) != '') {
			Session::put('active', $magazineid);
		} 
		else if(Session::get('active', '0') == '') {
			Session::put('active', Magazines::getActive());
		}
	}

	protected function navigationList($articles, $magazines) {
		$magazineList = "";
		$magazineList .= "{name: '#1 Farbe', url: '/1'}, ";
		foreach($magazines as $m) {
			$magazineList .= "{name: '#".$m->version." ".$m->title."', url: '/".$m->magazine_id."/splace'}, ";
		}

		$articleList = "{url: '/".Session::get('active', 2)."/splace', title: 'Cover', subtitle: '', spitzmarke: ''},
				{url: '/help', title: 'Hilfe', subtitle: '', spitzmarke: ''},
				{url: '/".Session::get('active', 2)."/content', title: 'Inhaltsverzeichnis', subtitle: 'Index', spitzmarke: ''},
				{url: '/".Session::get('active', 2)."/editorial', title: 'Editorial', subtitle: 'Editorial', spitzmarke: ''},";

		foreach ($articles as $a) {
			if(Session::get('language', 'de') == 'de') {
				$articleList .= "\n {url: '/".$a->magazine_id."/article/".$a->number."', title: '".$a->titleDE."', subtitle: '".$a->page_sub_titleDE."', spitzmarke: '".$a->spitzmarke."'},";
			}
			else {
				$articleList .= "\n {url: '/".$a->magazine_id."/article/".$a->number."', title: '".$a->titleEN."', subtitle: '".$a->page_sub_titleEN."', spitzmarke: '".$a->spitzmarke."'},";
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
