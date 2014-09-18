<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $users = array(
            array(
                'userid'        => 'admin@example.org',
                'name'          => 'admin',
                'email'         => 'admin@example.org',
                'password'      => Hash::make('admin'),
                'role'          => 'UL1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ),
            array(
                'userid'        => 'staff@example.org',
                'name'          => 'staff',
                'email'         => 'staff@example.org',
                'password'      => Hash::make('staff'),
                'role'          => 'UL2',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ),
            array(
                'userid'        => 'cladmin@example.org',
                'name'          => 'cladmin',
                'email'         => 'cladmin@example.org',
                'password'      => Hash::make('cladmin'),
                'role'          => 'CL1',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            ),
            array(
                'userid'        => 'eclient@example.org',
                'name'          => 'eclient',
                'email'         => 'eclient@example.org',
                'password'      => Hash::make('client'),
                'role'          => 'CL2',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime
            )
        );

        DB::table('users')->insert( $users );
    }

}

?>