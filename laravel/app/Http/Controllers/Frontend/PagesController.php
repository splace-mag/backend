<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\MainController;
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

class PagesController extends MainController {

	/*
	|--------------------------------------------------------------------------
	| Article Controller
	|--------------------------------------------------------------------------
	*/

	public function index($magazineid = '-1')
	{		
		$this->setMagazine($magazineid);
		return view('frontend/splace')
			->with('navigation', $this->navigationList(Article::getArticleList(Session::get('active', Magazines::getActive())), Magazines::getAll()))
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('language', Session::get('language', 'de'));
	}

	public function showContents($magazineid = '-1')
	{		
		$this->setMagazine($magazineid);
		$article = Article::getArticleList(Session::get('active', Magazines::getActive()));
		return view('frontend/contents')
			->with('navigation', $this->navigationList($article, Magazines::getAll()))
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('article', $article)
			->with('language', Session::get('language', 'de'));
	}

	public function showEditorial($magazineid = '-1')
	{		
		$this->setMagazine($magazineid);
		return view('frontend/editorial')
			->with('navigation', $this->navigationList(Article::getArticleList(Session::get('active', Magazines::getActive())), Magazines::getAll()))
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('language', Session::get('language', 'de'));
	}

	public function showHelpPage($magazineId = '-1')
	{		
		return view('frontend/help')
			->with('navigation', $this->navigationList(Article::getArticleList(Session::get('active', Magazines::getActive())), Magazines::getAll()))
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('language', Session::get('language', 'de'));
	}

	public function showArticle($magazineid = '-1', $number)
	{		
		$this->setMagazine($magazineid);

		$article = Article::getByNumber($magazineid, $number);
		if($article == '') {
			$article = Article::getByNumber(Magazines::getActive(), 1);
		}

		$navigationList = $this->navigationList(Article::getArticleList(Magazines::getActive()), Magazines::getAll());

		$sections = Section::getAllByArticle($article->article_id);
		foreach($sections as $s) {
			$s->comments = Comments::getBySectionForArticle($s->section_id);
			$s->media = Section::getMedia($s->section_id);
		}

		$backgroundHexColor = $article->subtitle_backgroundcolor;
		list($r, $g, $b) = sscanf($backgroundHexColor, "#%02x%02x%02x");
		$backgroundRgbColor = ['r' => $r, 'g' => $g, 'b' => $b];

		return view('frontend/article')
			->with('article', $article)
			->with('magazine', Magazines::getById(Session::get('active', Magazines::getActive())))
			->with('navigation', $navigationList) 
			->with('sections', $sections)
			->with('links', Links::getByArticle($article->article_id))
			->with('booktips', Booktips::getByArticle($article->article_id))
			->with('language', Session::get('language', 'de'))
			->with('backgroundRGB', $backgroundRgbColor);
	}
}
