<?php

use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
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
                'email' => 'admin@app.dev',
                'name' => 'app',
                'phone' => '081',
                'api' => '{"EMAIL_APP_ID": "eeeeeeee1", "EMAIL_API_KEY": "eeeeeee3", "GOOGLE_APP_ID": "go1", "Speech_APP_ID": "eeeeeee2", "GOOGLE_API_KEY": "go3", "Speech_API_KEY": "sssssssss1", "FACEBOOK_APP_ID": "fb1", "FACEBOOK_API_KEY": "fb2", "GOOGLE_CLIENT_KEY": "go4", "GOOGLE_SECRET_KEY": "go2", "FACEBOOK_CLIENT_KEY": "fb4", "FACEBOOK_SECRET_KEY": "fb3", "NOTIFICATION_APP_ID": "nnnnnnnnnnnnnn2", "NOTIFICATION_API_KEY": "nnnnnnnnnn1"}',
            ]
        );
        DB::table('master')->insert($setting);
    }
}
