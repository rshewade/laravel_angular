<?php

class UsersController extends BaseController{

	public function getusers(){
		$role = Auth::user()->role;
		switch ($role) {
			case 'UL1':
				// $users = DB::table('users')->select('id', 'userid', 'name', 'email', 'role', 'status', 'verified_on')->get();
				$users = User::get();
				break;	
			case 'UL2':
				// $users = DB::table('users')->whereIn('role', array('Cl1', 'CL2'))->get();
				$users = User::whereIn('role', array('Cl1', 'CL2'))->get();
				break;
			case 'CL1':
				$users = User::where('role', 'CL2')->get();
				break;
			case 'CL2':
				return Response::json(array('flash' => 'Not Authorized'), 401);
				break;
		}
		
		return Response::json($users);
	}

	Public function getuser($id){
		$role = Auth::user()->role;
		return Response::json(User::find($id));
	}
}

?>