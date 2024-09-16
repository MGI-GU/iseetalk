<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermisionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermisionRolesTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TeamUsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        //ADDTIONAL
        $this->call(MasterSeeder::class);
        $this->call(AttachmentTableSeeder::class);
        
    }
}
