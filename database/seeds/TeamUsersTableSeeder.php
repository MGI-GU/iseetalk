<?php

use Illuminate\Database\Seeder;

class TeamUsersTableSeeder extends Seeder
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
                'team_id' => 0,
                'user_id' => 1,
                'role_id' => 1,
            ]
        );
        DB::table('team_user')->insert($data);
    }
}
