<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Auth;
use Redirect;
use Request;
use Socialize;
use App;
use App\User;

class AccountController extends Controller {

	public function authenticate() {
		if(Auth::check() || Auth::attempt(['email' => Request::input('email'), 'password' => Request::input('password')])) {

			$user = Auth::user();
			$response = array( 
				'success' => true, 
				'user' => array(
					'id' => $user->id, 
					'name' => $user->name, 
					'email' => $user->email, 
					'image' => $user->picture
				)
			);
		}
		else {
			$response['success'] = false;
			$response['error'] = 'error';
		}
		return response()->json($response);
	}

	public function register() {
		$filename = '';
		if(Request::hasFile('image')) {
			$image = Request::file('image');
			$filename = $this->createFileName($image);
			$image->move(public_path('images'), $filename);
		}

		$user = array(
			'name' => Request::input('name'), 
			'email' => Request::input('email'), 
			'password' => \Hash::make(Request::input('password')), 
			'image' => $filename);

		$returnValue = User::createUser($user);
		if($returnValue['error'] != '-') {
			$response = array(
				'success' => false, 
				'error' => $returnValue['error']);
		}
		else {
			Auth::loginUsingId($returnValue['id']);
			$response = array(
				'success' => true, 
				'user' => array(
					'id' => Auth::user()->id, 
					'name' => Auth::user()->name, 
					'email' => Auth::user()->email, 
					'image' => Auth::user()->picture));
		}

		return response()->json($response);
	}

	private function createFileName($file) {
		$filename = str_random(20).'.'.$file->getClientOriginalExtension();
		if(User::where('picture', $filename)->count() > 0) {
			createFileName();
		}
		return $filename;
	}

	public function editProfile() {
		$filename = '-';
		if(Request::hasFile('image')) {
			$image = Request::file('image');
			$filename = $this->createFileName($image);
			$image->move(public_path('images'), $filename);
		}
		$user = array(
			'id' => Request::input('id'), 
			'name' => Request::input('name', '-'), 
			'email' => Request::input('email', '-'), 
			'password' => Request::input('password', '-'), 
			'image' => $filename);

		User::editUser($user);

		return response()->json(array('success' => true));
	}

	public function logout() {
		Auth::logout();
	}

	public function resetPassword() {
		$user['mail'] = Request::input('email');

		if(!User::findUser($user['mail'])) {
			return response()->json(array('success' => false, 'error' => 'email not found'));
		}

		$user['password'] = str_random(12);
		
		User::changePassword($user['mail'], \Hash::make($user['password']));
		\Mail::send('emails.resetPassword', $user, function($message)
		{
		    $message->to('s@applics.at')->subject('Password Reset');
		});

		return response()->json(array('success' => true));
	}

	/*
	*
	* Login with Facebook
	*
	*/

	public function redirectToFacebook()
	{
	    return Socialize::with('facebook')->redirect();
	}

	public function facebookLogin()
	{
	    $user = Socialize::with('facebook')->user();
		$token = $user->token;


		$userId = User::createFacebookUser($user);

		Auth::loginUsingId($userId);

		$response = array( 
			'success' => true, 
			'user' => array(
				'id' => $userId, 
				'name' => $user->getName(), 
				'email' => $user->getEmail(), 
				'image' => $user->getAvatar()), 
			'fb-token' => $token
		);

		\Log::info($user->getId().': '.$user->getName().', SystemId: '.$userId);
		return redirect(\URL::previous())->with('user', $response['user']);
		//return response()->json($response);
	}

	/*
	*
	* Login with Facebook
	*
	*/

	public function redirectToTwitter()
	{
	    return Socialize::with('twitter')->redirect();
	}

	public function twitterLogin()
	{
	    $user = Socialize::with('twitter')->user();

		$token = $user->token;

		/*
		// All Providers
		$user->getId();
		$user->getNickname();
		$user->getName();
		$user->getEmail();
		$user->getAvatar()
		*/

	    return redirect('home')->send();
	}

	public function changeLocale($lang) {
		if($lang == 'de') {
			Session::put('language', 'de');
		}
		else {
			Session::put('language', 'en');
		}
		return response()->json(['language' => $lang]);
	}

}
