<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Redirect;
use Socialize;
use App;

class AccountController extends Controller {


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

		/*
		// All Providers
		$user->getId();
		$user->getNickname();
		$user->getName();
		$user->getEmail();
		$user->getAvatar();
		*/

		\Log::info($user->getId().': '.$user->getName());

		return redirect('home')->send();
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
		$user->getAvatar();
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
		return redirect()->back();
	}

}
