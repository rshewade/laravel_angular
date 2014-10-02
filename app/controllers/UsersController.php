<?php

class UsersController extends BaseController{

	public function getusers(){
		$users = $this->users();
		return Response::json($users);
	}

	protected function users(){
		$role = Auth::user()->role;
		switch ($role) {
			case 'UL1':
				$users = User::get();
				break;	
			case 'UL2':
				$users = User::whereIn('role', array('Cl1', 'CL2'))->get();
				break;
			case 'CL1':
				$users = User::where('role', 'CL2')->get();
				break;
			case 'CL2':
				break;
		}
		return $users;
	}
	Public function update($id){
		$role = Auth::user()->role;
		$user = User::find($id);
		$user->name = Input::json('name');
		$user->role = Input::json('role');
		try {
			$user->save();
			$users = $this->users();
			return Response::json($users);
		} catch (Exception $e){
			return Response::json(array('flash' => "Error occured while updating"), 500);
		}
		
	}

	
}

?>