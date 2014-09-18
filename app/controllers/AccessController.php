<?php

class AccessController extends BaseController{
	Public function getaccess(){
		$access = DB::table('access_db')->select('route','name')->where('role', Input::json('role'))->get();
		return Response::json($access);
	}

	public function getcode(){
		$code = Session::get('sescode');
		$ltime = Session::get('ltime');
		// $code = csrf_token().str_random(40) . time();
		$csrf = substr($code, 0,strlen($code)-50);
		$sescode = substr($code, 40,40);
		$timecode = substr($code, 80,10);
		return Response::json(time()-$ltime);
		}

	public function getcode1(){
		if (Session::has('ltime')){
			echo "ltime found ". csrf_token() ;
		} else {
			echo "ltime not found ". csrf_token();
		}
	}	
}

?>