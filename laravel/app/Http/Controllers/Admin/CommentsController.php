<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Registrar;
use App\Splace\Comments;
use Request;

class CommentsController extends Controller {

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
	 * Show a list of all comments
	 *
	 * @return Response
	 */
	public function index()
	{
		$comments = Comments::getAll();
		if(count($comments) == '0') {
			$warning = 'nocommentexists';
		}
		else {
			$warning = '-';
		}

		return view('admin/comments')
			->with('comments', $comments)
			->with('warning', $warning);
	}

	/**
	 * Show all comments to one article
	 *
	 * @return Response
	 */
	public function showArticleComments($article_id) {
		$comments = Comments::getByArticle($article_id);
		if(count($comments) == '0') {
			$warning = 'nocommentexists';
		}
		else {
			$warning = '-';
		}

		return view('admin/articlecomments')
			->with('comments', $comments)
			->with('warning', $warning);
	}

	/**
	 * Show comment for editing
	 *
	 * @return Response
	 */
	public function editComment($id)
	{

		if(!Comments::exists($id)) {
			return view('admin/comments')
				->with('comments', Comments::getAll())
				->with('warning', 'nocommentwiththisid');
		}

		Comments::markRead($id);
		
		$comments = Comments::getById($id);
		return view('admin/commenteditor')
			->with('comment', $comments);
	}

	/**
	 * Save edited Comment
	 *
	 * @return Response
	 */
	public function saveComment()
	{
		$comment = Request::input('comment');
		
		if(Comments::exists($comment['id'])) {
			Comments::markPublic($comment);
		}
		else {
			return response()->json(['success' => 'false'], 404);
		}

		return response()->json(['success' => 'true']);
	}

	/**
	 * Delete comment by id
	 *
	 * @return Response
	 */
	public function deleteComment($id)
	{
		Comments::deleteComment($id);

		return redirect('admin/comments');
	}

}
