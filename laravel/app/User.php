<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Carbon\Carbon;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public static function editUser($user) {
		if($user['password'] === '-') {
			User::where('id', $user['id'])
				->update([
					'name' => $user['name'], 
					'email' => $user['email']
				]);
		}
		else {
			User::where('id', $user['id'])
				->update([
					'name' => $user['name'], 
					'email' => $user['email'], 
					'password' => \Hash::make($user['password'])
				]);
		}
		if($user['image'] !== '-') {
			$filename = User::where('id', $user['id'])->first()->picture;
			\File::delete('images/'.$filename);

			User::where('id', $user['id'])
				->update(['picture' => $user['image']]);
		}
	}

	public static function createUser($user) {
		if(User::where('email', $user['email'])->count() > 0) {
			if(User::where('email', $user['email'])->where('fb_token', '<>', '')->count() > 0) {
				User::where('email', $user['email'])->where('fb_token', '<>', '')->update([
					'name' => $user['name'], 
					'picture' => $user['image'], 
					'password' => $user['password'], 
					'fb_token' => '', 
					'updated_at' => Carbon::now()]);
				$id = User::where('email', $user['email'])->first()->id;
			}
			else {
				return $data = array('error' => 'email already exists');
			}
		}
		else {
			$id = User::insertGetId([
				'name' => $user['name'], 
				'email' => $user['email'], 
				'picture' => $user['image'], 
				'password' => $user['password'], 
				'created_at' => Carbon::now()]);
		}

		return $data = array('id' => $id, 'error' => '-');
	}

	public static function createFacebookUser($user) {
		$id = '';
		$u = User::where('email', $user->getEmail())->first();
		if($u) {
			$id = $u->id;
		}

		if($id == '') {
			$id = User::insertGetId([
				'name' => $user->getName(), 
				'email' => $user->getEmail(), 
				'picture' => $user->getAvatar(), 
				'password' => str_random(40), 
				'fb_token' => $user->token, 
				'created_at' => Carbon::now()]);
		}
		else {
			User::where('id', $id)->update([
				'name' => $user->getName(), 
				'picture' => $user->getAvatar(), 
				'fb_token' => $user->token, 
				'updated_at' => Carbon::now()]);
		}

		return $id;
	}

}
