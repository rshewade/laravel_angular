<?php

class AccessTableSeeder extends Seeder{
	public function run(){
		DB::table('access_db')->delete();

		$access = array(
			array(
				'role'	=> 'UL1',
				'route'	=> '/home',
				'name'	=> 'Dashboard'
				),
			array(
				'role'	=> 'UL1',
				'route'	=> '/users',
				'name'	=> 'User Management'
				),
			array(
				'role'	=> 'UL1',
				'route'	=> '/report',
				'name'	=> 'Reports'
				)
			
			);
		DB::table('access_db')->insert( $access );

	}
}

?>