<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::get('users', function(){
	return 'Users!';
});


Route::group(array('before' => 'csrf_header'), function(){
	Route::post('/auth/login', 'AuthController@login');	
	
	Route::post('/access', array('before' => 'auth', 'uses' => 'AccessController@getaccess'));
	Route::get('/accesscode', array('before' => 'auth', 'uses' => 'AccessController@getcode'));		
	
	
});


Route::group(array('before' => 'auth'), function(){
		Route::get('/auth/logout', 'AuthController@logout');
		Route::post('/getsession','AuthController@getsession');
		Route::post('/getusers', 'UsersController@getusers');	
		Route::post('/update/{id}', 'UsersController@update');	
		
	});

Route::when('/UL1/*', 'IsUL1');

Route::get('/code', 'AccessController@getcode1');	

Route::get('/expiry', function(){
	return Response::json(array('flash' => 'your session has expired please log in...'), 401); 
});

Route::get('/books', array('before' => 'auth', function() {
  return Response::json(array(
    array('title' => 'Great Expectations', 'author' => 'Dickens'),
    array('title' => 'Foundation', 'author' => 'Asimov'),
    array('title' => 'Treasure Island', 'author' => 'Stephenson')
  ));
}));