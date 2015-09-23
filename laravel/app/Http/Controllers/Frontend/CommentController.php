<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Registrar;
use Auth;
use Request;
use App\Splace\Article;
use App\Splace\Section;
use App\Splace\Comments;

class CommentController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Comment Controller
	|--------------------------------------------------------------------------
	*/

	public function __construct()
	{
		$this->middleware('auth');
	}


	/**
	 * add a Comment to a Section
	 */
	public function addComment()
	{		
		$comment['user_id'] = Auth::user()->id;
		$comment['section_id'] = Request::input('paragraphId', -1);
		$comment['text'] = Request::input('comment', '');


		$id = Comments::createComment($comment);

		$response['success'] = true;
		$response['commentId'] = $id;

		return response()->json($response);
	}
}
