<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = array(
            [
                'name' => 'Master Admin',
                'email' => 'admin@audioable.com',
                'password' => bcrypt('admin'),
                'type' => 'admin',
                'role_id' => '1',
            ],
            [
                'name' => 'Creator',
                'email' => 'creator@audioable.com',
                'password' => bcrypt('admin'),
                'type' => 'creator',
                'role_id' => null,
            ],
            [
                'name' => 'Member',
                'email' => 'member@audioable.com',
                'password' => bcrypt('admin'),
                'type' => 'member',
                'role_id' => null,
            ],
            [
                'name' => 'Project manager',
                'email' => 'manager@audioable.com',
                'password' => bcrypt('admin'),
                'type' => 'admin',
                'role_id' => null,
            ],
            [
                'name' => 'Staf',
                'email' => 'staf@pankord.com',
                'password' => bcrypt('admin'),
                'type' => 'admin',
                'role_id' => null,
            ]
        );
        DB::table('users')->insert($user);


    }
}
