<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'name' => 'Super Admin',
                'role_for' => 'admin',
                'description' => 'All permisison role'
            ],
            [
                'name' => 'Master Admin',
                'role_for' => 'admin',
                'description' => 'All permisison role'
            ],
            [
                'name' => 'Project Leader',
                'role_for' => 'team',
                'description' => 'All permisison for own of the project'
            ],
            [
                'name' => 'Designer',
                'role_for' => 'team',
                'description' => 'All permisison to design of the project,'
            ],
            [
                'name' => 'Writer',
                'role_for' => 'team',
                'description' => 'All permisison to content writer of the project'
            ],
            [
                'name' => 'Recorder',
                'role_for' => 'team',
                'description' => 'All permisison to content audio of the project'
            ],
            [
                'name' => 'Auditor',
                'role_for' => 'team',
                'description' => 'Permisison only for audit'
            ]
        );

        DB::table('roles')->insert($data);
    }
}
