<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = array(
            [
                'user_id' => '1',
            ],
            [
                'user_id' => '2',
            ],
            [
                'user_id' => '3',
            ],
            [
                'user_id' => '4',
            ],
            [
                'user_id' => '5',
            ]
        );
        DB::table('settings')->insert($setting);
    }
}
