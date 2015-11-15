<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Registrar;
use App\Splace\Section;
use Request;

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
		$sections = Section::getAll(Session::get('active'));
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
				->with('sections', Section::getAll(Session::get('active')))
				->with('warning', 'nosectionwiththisid');
		}

		return view('admin/sectioneditor')
			->with('section', Section::getById($id))
			->with('media', Section::getMedia($id));
	}

	/**
	 * Save edited Section
	 *
	 * @return Response
	 */
	public function saveSection()
	{
		$section = Request::input('section');
		
		if(Section::exists($section['id'])) {
			Section::editSection($section);

			$media = Request::input('media');
			if($media != 'undefined') {
				Section::saveMediaDescription($media);
			}
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

	public function sortSections() 
	{
		$sections = Request::input('sections');

		if(count($sections) > 0) {
			foreach($sections as $section) {
				Section::sortSection($section);
			}
		}
			
		
		return response()->json(['success' => 'true']);
	}

	public function fileUpload($id) 
	{
		if(Request::hasFile('media-file-image')) {
			$file = Request::file('media-file-image');
			$filename = time().$file->getClientOriginalName();
			$file->move(public_path('images'), $filename);
			
			Section::saveMedia($id, $filename, $file->getClientOriginalName(), 'image', Request::input('image-descriptionDE', ''), Request::input('image-descriptionEN', ''));
		}
		if(Request::has('media-youtube-video')) {
			$name = Request::input('media-youtube-video', '-');
			\Log::info('Youtube: X'.$name.'X');
			Section::saveMedia($id, '', $name, 'youtube-video', Request::input('youtube-video-descriptionDE', ''), Request::input('youtube-video-descriptionEN', ''));
		}
		if(Request::has('media-vimeo-video')) {
			$name = Request::input('media-vimeo-video', '-');
			Section::saveMedia($id, '', $name, 'vimeo-video', Request::input('vimeo-video-descriptionDE', ''), Request::input('vimeo-video-descriptionEN', ''));
		}
		if(Request::hasFile('media-file-image-cover')) {
			$file = Request::file('media-file-image-cover');
			$filename = time().$file->getClientOriginalName();
			$file->move(public_path('images'), $filename);
			
			Section::saveMedia($id, $filename, $file->getClientOriginalName(), 'cover', Request::input('gallery-thumbnail-descriptionDE', ''), Request::input('gallery-thumbnail-descriptionEN', ''));
		}

		for($i = 0; $i < Request::input('gallery_items', 0); $i++) {
			if(Request::hasFile('media-file-gallery-'.$i)) {
				$file = Request::file('media-file-gallery-'.$i);
				$filename = time().$file->getClientOriginalName();
				$file->move(public_path('images'), $filename);
				
				Section::saveMedia($id, $filename, $file->getClientOriginalName(), 'gallery', '', '');
			}
		}
		
		return response()->json(['success' => 'true']);
	}

	public function deleteMediaItem($sectionId, $filename) {
		if(\File::exists('images/'.$filename)) {
			\File::delete('images/'.$filename);
			Section::deleteMedia($filename);
		}

		return redirect('admin/sections/'.$sectionId);
	}

}
