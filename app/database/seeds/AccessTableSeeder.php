<?php

class AccessTableSeeder extends Seeder{
	public function run(){
		DB::table('access_db')->delete();

		$access = array(
			array(
				'role'		=> 'UL1',
				'eroute'	=> '/home',
				'iroutes'	=> '',
				'name'		=> 'Dashboard',
				'parentid'	=> 0
				),
			array(
				'role'		=> 'UL1',
				'eroute'	=> '/users',
				'iroutes'	=> '',
				'name'		=> 'User Management',
				'parentid'	=> 0
				),
			array(
				'role'		=> 'UL1',
				'eroute'	=> '/report',
				'iroutes'	=> '',
				'name'		=> 'Reports',
				'parentid'	=> 0
				)
			
			);
		DB::table('access_db')->insert( $access );

	}
}

?>