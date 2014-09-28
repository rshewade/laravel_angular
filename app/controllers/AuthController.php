<?php

class AuthController extends BaseController{

	public function login(){
		if(Auth::attempt(array('email' => Input::json('email') , 'password' => Input::json('password')))){
			// Session::flush();
			$ltime = time();
			$code = csrf_token().str_random(40) . $ltime;
			$usr = Auth::user();
			$access = DB::table('access_db')->select('eroute','name')->where('role', $usr->role)->get();
			$usr->routes = $access;
			$usr->code = $code;
			Session::put('ltime',$ltime);
			Session::put('sescode',$code);
			return Response::json($usr);
		} else {
			return Response::json(array('flash' => 'Invalid username or password'), 500);
		}
	}

	public function logout(){
		Session::forget('ltime');
		Session::forget('sescode');
		Auth::logout();
		return Response::json(array('flash' => 'Logged Out !'));
	}

	public function getsession(){
		$code = Session::get('sescode');
		$csrf = $csrf = substr($code, 0,strlen($code)-50);		
		if ($csrf == csrf_token()){
			$usr = Auth::user();
			$access = DB::table('access_db')->select('eroute','name')->where('role', $usr->role)->get();
			$usr->routes = $access;
			$usr->code = $code;
			return Response::json($usr);	
		} else {
			return Response::json(array('flash' => 'Session Mismatch'), 401);	
		}
		
	}
}

?>