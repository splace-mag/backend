<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Redirect;
use Socialize;

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

	    // OAuth Two Providers
		$token = $user->token;

		// OAuth One Providers
		$token = $user->token;

		// All Providers
		$user->getId();
		$user->getNickname();
		$user->getName();
		$user->getEmail();
		$user->getAvatar();

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

	    // OAuth Two Providers
		$token = $user->token;

		// OAuth One Providers
		$token = $user->token;

		// All Providers
		$user->getId();
		$user->getNickname();
		$user->getName();
		$user->getEmail();
		$user->getAvatar();

	    return redirect('home')->send();
	}

}
