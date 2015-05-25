<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Registrar;
use App\Splace\Section;

class SectionsController extends Controller {

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
	 * Show a list of all sections
	 *
	 * @return Response
	 */
	public function index()
	{
		$sections = Section::getAll();
		if(count($sections) == '0') {
			$warning = 'nosectionexists';
		}
		else {
			$warning = '-';
		}

		return view('admin/sections')
			->with('sections', $sections)
			->with('warning', $warning);
	}

	/**
	 * Show all sections to one article
	 *
	 * @return Response
	 */
	public function showArticleSections($article_id) {
		$sections = Section::getByArticle($article_id);
		if(count($sections) == '0') {
			$warning = 'nosectionexists';
		}
		else {
			$warning = '-';
		}

		return view('admin/sections')
			->with('sections', $sections)
			->with('warning', $warning);
	}

	/**
	 * Show section to edit notes
	 *
	 * @return Response
	 */
	public function editSection($id)
	{
		if(!Section::exists($id)) {
			return view('admin/sections')
				->with('sections', Section::getAll())
				->with('warning', 'nosectionwiththisid');
		}

		return view('admin/sectioneditor')
			->with('section', section::getById($id));
	}

	/**
	 * Save edited Section
	 *
	 * @return Response
	 */
	public function saveSection()
	{
		$section = Input::get('section');
		
		if(Section::exists($section['id'])) {
			Section::editSection($section);
		}
		else {
			return response()->json(['success' => 'false'], 404);
		}

		return response()->json(['success' => 'true']);
	}

	/**
	 * Delete section by id
	 *
	 * @return Response
	 */
	public function deleteSection($id)
	{
		Section::deleteSection($id);

		return redirect('admin/sections');
	}

}
