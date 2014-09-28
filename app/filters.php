<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (!Auth::check()){
		return Response::json(array('flash' => 'Please log in'), 401);
	}
	// if (Auth::guest())
	// {
	// 	if (Request::ajax())
	// 	{
	// 		return Response::make('Unauthorized', 401);
	// 	}
	// 	else
	// 	{
	// 		return Redirect::guest('login');
	// 	}
	// }
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/
Route::filter('csrf_header', function($route, $request){
	$code = $request->header('X-Csrf-Token');
	if ($code == "" || !Session::has('ltime') ){
		if (Session::token() != Input::json('csrf_token'))
		{
			// throw new Illuminate\Session\TokenMismatchException;
			Session::forget('ltime');
			Session::forget('sescode');
			return Response::json(array('flash' => 'Session invalidated'), 401);
		} 	
	} else {	
	$csrf = substr($code, 0,strlen($code)-50);
	$sescode = substr($code, 40,40);
	$timecode = substr($code, 80,10);
	if (Session::token() != $csrf){
			Session::forget('ltime');
			Session::forget('sescode');
			throw new Illuminate\Session\TokenMismatchException;
			// return Response::json(array('flash' => 'invalid token'), 401);
	} else {
		if (Session::get('sescode') == $code){
			$ltime = Session::get('ltime');
			if ((time() - $ltime) < 600) {
				Session::put('ltime',time());
			} else {
				Session::forget('ltime');
				Session::forget('sescode');
				return Response::json(array('flash' => 'Session Time Out'), 401);
			}		
		} else {
			Session::forget('ltime');
			Session::forget('sescode');
			return Response::json(array('flash' => 'Session invalidated'), 401);
		}
	}	 
}});
Route::filter('csrf_json', function(){
	
	if (Session::token() != Input::json('csrf_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}	
});


Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
