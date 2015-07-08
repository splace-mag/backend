<?php namespace App\Splace;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Comments extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	public $timestamps = false;

	public static function getAll() {
		return Comments::join('articles', 'comments.article_id', '=', 'articles.article_id')
			->join('sections', 'comments.section_id', '=', 'sections.section_id')
			->join('users', 'comments.user_id', '=', 'users.id')
			->select('comments.comment_id', 'users.name', 'articles.article_id', 'articles.titleDE', 'sections.section_id', 'sections.key', 'comments.user_id', 'comments.text', 'comments.read', 'comments.marked', 'comments.created_at')
			->paginate(15);
	}

	public static function getUnread() {
		return Comments::join('articles', 'comments.article_id', '=', 'articles.article_id')
			->where('comments.read', '=', false)
			->groupBy('comments.article_id')
			->select(DB::raw('count(*) as count'),'comments.article_id', 'articles.titleDE')
			->get();
	}

	public static function getById($id) {
		return Comments::where('comment_id', $id)
			->join('articles', 'comments.article_id', '=', 'articles.article_id')
			->join('sections', 'comments.section_id', '=', 'sections.section_id')
			->join('users', 'comments.user_id', '=', 'users.id')
			->select('comments.comment_id', 'users.id', 'users.name', 'articles.article_id', 'articles.titleDE', 'sections.section_id', 'sections.key', 'comments.user_id', 'comments.text', 'comments.read', 'comments.marked', 'comments.created_at')
			->first();
	}

	public static function getByArticle($article_id) {
		return Comments::where('comments.article_id', '=', $article_id)
			->join('articles', 'comments.article_id', '=', 'articles.article_id')
			->join('sections', 'comments.section_id', '=', 'sections.section_id')
			->join('users', 'comments.user_id', '=', 'users.id')
			->select('comments.comment_id', 'users.name', 'articles.article_id', 'articles.titleDE', 'sections.section_id', 'sections.key', 'comments.user_id', 'comments.text', 'comments.read', 'comments.marked')
			->paginate(15);
	}

	public static function getBySectionForArticle($section_id) {
		return Comments::where('comments.section_id', '=', $section_id)
			->join('users', 'comments.user_id', '=', 'users.id')
			->select('comments.comment_id', 'users.name', 'comments.user_id', 'comments.text')
			->get();
	}
	
	public static function exists($id) {
		if(Comments::where('comment_id', $id)->count() == '1') {
			return true;
		}
		return false;
	}


	public static function createComment($comment) {
		Comments::insert([
			'user_id' => $comment['user_id'], 
			'section_id' => $comment['section_id'], 
			'text' => $comment['text'], 
			'created_at' => new Carbon]);
	}

	public static function editComment($comment) {
		Comments::where('comment_id', $comment['id'])
			->update([
				'section_id' => $comment['section_id'], 
				'text' => $comment['text'], 
				'updated_at' => new Carbon]);
	}

	public static function markRead($id) {
		Comments::where('comment_id', $id)
			->update([
				'read' => '1', 
				'updated_at' => new Carbon]);
	}

	public static function markPublic($comment) {
		Comments::where('comment_id', $comment['id'])
			->update([
				'marked' => $comment['marked'], 
				'text' => $comment['text']]);
	}

	public static function deleteComment($id) {
		Comments::where('comment_id', $id)->delete();
	}

}
