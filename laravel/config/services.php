<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],

	'facebook' => [
		'client_id' => '1576537259300886',
	    'client_secret' => '7ba64803d098cd18b1df289eb64aadc2',
	    'redirect' => 'http://www.splace.local/account/facebook',
	], 

	'twitter' => [
		'client_id' => 'app-id',
	    'client_secret' => 'app-pw',
	    'redirect' => 'http://www.splace.local/admin',
	]

];
